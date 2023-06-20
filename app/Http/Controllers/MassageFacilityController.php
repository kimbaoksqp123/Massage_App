<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\MassageFacilityResource;
use App\Models\ImageLibrary;
use App\Models\MassageFacility;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Query\JoinClause;
use App\Models\MassageService;
use App\Models\ServicePrice;
use App\Models\User;
use App\Models\Rating;
use App\Models\Staff;
use Illuminate\Http\Request;

class MassageFacilityController extends Controller
{
    // return all massage facilities
    public function index()
    {
        // lấy giá tiền của service rẻ nhất và đắt nhất
        $minPriceAllFacility = ServicePrice::orderBy('price', 'asc')->first()->price;
        $maxPriceAllFacility = ServicePrice::orderBy('price', 'desc')->first()->price;

        $MassageFacilities = MassageFacilityResource::collection(MassageFacility::all());
        $MassageServices = MassageService::select('serviceName')->groupBy('serviceName')->get();

        return [
            'result' => $MassageFacilities,
            'serviceList' => $MassageServices,
            'minPrice' => $minPriceAllFacility,
            'maxPrice' => $maxPriceAllFacility,
        ];
    }

    // filter massage facilities
    public function filter(Request $req)
    {

        // instantiate query
        $query = MassageFacility::query();

        // name, address
        if ($req->__isset('input')) {

            $input = $req->input;

            $nameWithoutSpaces = "REPLACE(REPLACE(REPLACE(name, ' ', ''), '\t', ''), '\n', '')";
            $locationWithoutSpaces = "REPLACE(REPLACE(REPLACE(location, ' ', ''), '\t', ''), '\n', '')";

            $subQuery = MassageFacility::selectRaw("
                id AS sub_query_id,
                $nameWithoutSpaces AS nameWithoutSpaces,
                $locationWithoutSpaces AS locationWithoutSpaces
            ");

            $query->joinSub(
                $subQuery,
                'sub_query',
                function (JoinClause $join) {
                    $join->on('id', '=', 'sub_query_id');
                }
            )
                ->where(function (Builder $query) use ($input) {

                    $inputWithSpaces = trim($input);
                    $inputWithoutSpaces = preg_replace('/\s+/', '', $input);

                    $query->whereRaw("TRIM(name) LIKE ?", ['%' . $inputWithSpaces . '%'])
                        ->orWhereRaw("TRIM(location) LIKE ?", ['%' . $inputWithSpaces . '%'])
                        ->orWhereRaw("nameWithoutSpaces LIKE ?", ['%' . $inputWithoutSpaces . '%'])
                        ->orWhereRaw("locationWithoutSpaces LIKE ?", ['%' . $inputWithoutSpaces . '%']);
                });
        }

        // massage service
        if ($req->__isset('serviceList')) {

            $serviceList = $req->serviceList;

            $query->with('massage_services')
                ->whereHas('massage_services', function (Builder $query) use ($serviceList) {
                    $query->whereIn('serviceName', $serviceList);
                });
        }

        // price
        if ($req->__isset('minPrice') && $req->__isset('maxPrice')) {

            $minPrice = $req->minPrice;
            $maxPrice = $req->maxPrice;

            $serviceSearchIds = ServicePrice::where('price', '>=', $minPrice)->where('price', '<=', $maxPrice)->pluck('serviceID')->toArray();
            $facilitySearchIds = MassageService::whereIn('id', $serviceSearchIds)->pluck('facilityID')->toArray();

            $query->whereIn('id', $facilitySearchIds);
        }

        // rate
        if ($req->__isset('minRate') && $req->__isset('maxRate')) {

            $minRate = $req->minRate;
            $maxRate = $req->maxRate;

            $query->where('averageRating', '>=', $minRate)->where('averageRating', '<=', $maxRate);
        }


        return [
            'result' => MassageFacilityResource::collection($query->get()),
        ];
    }

    // show detail
    public function detail($id)
    {
        $inforFacility = MassageFacility::where('id', '=', $id)
            ->get(['id', 'name', 'phoneNumber AS phone', 'location AS address', 'description']);

        //danh sách ảnh của 1 quán
        $imgList = ImageLibrary::where('facilityID', '=', $id)->pluck('imageURL')->toArray();

        // danh sách staff của quán
        $staffList = Staff::where('facilityID', $id)->get()->toArray();

        // danh sách các dịch vụ của quán
        $serviceList = MassageService::where('facilityID', '=', $id)->get(['id', 'serviceName', 'serviceDescription']);

        // thêm giá tiền cùng thời gian phục vụ cho từng service
        foreach ($serviceList as $serviceItem) {

            $servicePriceItem = ServicePrice::where('serviceID', '=', $serviceItem->id)
                ->get(['serviceID', 'id AS priceID', 'price', 'durationTime AS duration']);
            $serviceItem['servicePrice'] = $servicePriceItem;
        }

        // TODO: thêm avatar cho user
        // thêm rating cho quán
        $rateList = Rating::where('facilityID', '=', $id)->get(['id AS ratingID', 'userID', 'comment', 'commentVoteup AS rate']);

        foreach ($rateList as $rateItem) {
            $userInfo = User::where('id', '=', $rateItem->userID)->get(['username', 'avatarImageUrl'])->first();
            $rateItem['username'] = $userInfo['username'];
            $rateItem['avatarImageUrl'] = $userInfo['avatarImageUrl'];
        }

        foreach ($inforFacility as $value) {

            $value['imgList'] = $imgList;
            $value['serviceList'] = $serviceList;
            $value['ratingList'] = $rateList;
            $value['staffList'] = $staffList;
        }

        return $inforFacility;
    }

    // store to database
    public function store(Request $req)
    {
        $imageLibraryController = new ImageLibraryController();
        $staffController = new StaffController();
        $massageServiceController = new MassageServiceController();
        $createRequestController = new CreateRequestController();

        $ownerID = $req->user()->id;
        $name = $req->name;
        $description = $req->description;
        $location = $req->location;
        $phoneNumber = $req->phoneNumber;
        $emailAddress = $req->emailAddress;

        // lưu thông tin massage facility
        $massageFacility = MassageFacility::create([
            'ownerID' => $ownerID,
            'name' => $name,
            'description' => $description,
            'location' => $location,
            'phoneNumber' => $phoneNumber,
            'emailAddress' => $emailAddress,
        ]);

        // lưu ảnh vào bảng image_librarys
        $imageLibraryController->store($req, $massageFacility);

        // lưu staff vào bảng staffs
        if ($req->__isset('staffList') && !empty($req->staffList)) {
            foreach ($req->staffList as $staffRequest) {
                $staffController->store($staffRequest, $massageFacility);
            }
        }

        // lưu service và giá vào bảng massage_services và bảng service_prices
        if ($req->__isset('serviceList') && !empty($req->serviceList)) {

            $services = $req->serviceList;
            foreach ($services as $service) {
                $massageServiceController->store($service, $massageFacility);
            }
        }

        // tạo create request tương ứng với massage facility hiện tại,
        // và lưu vào bảng create_requests
        $createRequestController->store($massageFacility->id, $massageFacility->ownerID);

        return response('ok');
    }
}
