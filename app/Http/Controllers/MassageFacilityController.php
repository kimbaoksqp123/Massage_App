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
        $servicePrices = ServicePrice::with(['massage_service' => function ($query) {
            $query->with(['massage_facility' => function ($query) {
                $query->where('isActive', 1);
            }]);
        }])->orderBy('price', 'asc')->get();

        foreach ($servicePrices as $key => $value) {
            if (empty($value->massage_service->massage_facility))
                unset($servicePrices[$key]);
        }

        $minPriceAllFacility = $servicePrices->first()->price;    
        $maxPriceAllFacility = $servicePrices->last()->price;

        // Danh sách toàn bộ cơ sở massage
        $massageFacilities = MassageFacilityResource::collection(MassageFacility::where('isActive', 1)->get());

        // Danh sách massage service
        $massageServices = MassageService::with(['massage_facility' => function ($query) {
            $query->where('isActive', 1);
        }])->get();

        foreach ($massageServices as $key => $value) {
            if (empty($value->massage_facility)) {
                unset($massageServices[$key]);
            }
        }

        $massageServices = $massageServices->unique('serviceName')->pluck('serviceName')->toArray();

        return [
            'result' => $massageFacilities,
            'serviceList' => $massageServices,
            'minPrice' => $minPriceAllFacility,
            'maxPrice' => $maxPriceAllFacility,
        ];
    }

    // filter massage facilities
    public function filter(Request $req)
    {

        // instantiate query
        $query = MassageFacility::query();

        // quán đang hoạt động
        $query->where('isActive', 1);

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

        foreach ($imgList as $key => $value) {
            $imgList[$key] = asset($value);
        }

        // danh sách staff của quán
        $staffList = Staff::where('facilityID', $id)->get()->toArray();

        foreach ($staffList as $key => $value) {
            $staffList[$key]['image'] = asset($value['image']);
            $staffList[$key]['certificateImage'] = asset($value['certificateImage']);
        }

        // danh sách các dịch vụ của quán
        $serviceList = MassageService::where('facilityID', '=', $id)->get(['id', 'serviceName', 'serviceDescription', 'imageURL AS serviceImg']);

        // thêm giá tiền cùng thời gian phục vụ cho từng service
        foreach ($serviceList as $serviceItem) {

            $servicePriceItem = ServicePrice::where('serviceID', '=', $serviceItem->id)
                ->get(['serviceID', 'id AS priceID', 'price', 'durationTime AS duration']);
            $serviceItem['servicePrice'] = $servicePriceItem;
            $serviceItem['serviceImg'] = asset($serviceItem['serviceImg']);
        }

        // TODO: thêm avatar cho user
        // thêm rating cho quán
        $ratingController = new RatingController();
        $rateList = $ratingController->index($id);

        foreach ($inforFacility as $value) {

            $value['imgList'] = $imgList;
            $value['serviceList'] = $serviceList;
            $value['ratingList'] = $rateList['ratingList'];
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
            'isActive' => 0,
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

    public function updateAvarageRating($id) {

        $commentVoteups = Rating::where('facilityID', $id)->pluck('commentVoteup')->toArray();

        $facility = MassageFacility::find($id);
        $facility->averageRating = round(array_sum($commentVoteups) / count($commentVoteups), 1);
        $facility->save();
    }
}
