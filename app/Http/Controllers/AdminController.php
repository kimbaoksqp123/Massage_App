<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\CreateRequest;
use App\Models\User;
use App\Models\MassageFacility;
use App\Http\Resources\MassageFacilityResource;
use App\Models\ImageLibrary;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Query\JoinClause;
use App\Models\MassageService;
use App\Models\ServicePrice;
use App\Models\Rating;
use App\Models\Staff;

class AdminController extends Controller
{
    public function index()
    {
        // lấy giá tiền của service rẻ nhất và đắt nhất
        $servicePrices = ServicePrice::orderBy('price', 'asc')->get();
        $minPriceAllFacility = $servicePrices->first()->price;    
        $maxPriceAllFacility = $servicePrices->last()->price;

        // Danh sách toàn bộ cơ sở massage
        $massageFacilities = MassageFacilityResource::collection(MassageFacility::get());

        // Danh sách massage service
        $massageServices = MassageService::get();
        $massageServices = $massageServices->unique('serviceName')->pluck('serviceName')->toArray();

        return [
            'result' => $massageFacilities,
            'serviceList' => $massageServices,
            'minPrice' => $minPriceAllFacility,
            'maxPrice' => $maxPriceAllFacility,
        ];
    }

    public function requestNotActive() {
        $requestOpenList = CreateRequest::where('requestStatus', 0)->orWhere('requestStatus', 2)->get([
            'id as requestID', 'facilityID', 'requestStatus as status', 'createdDate', 'userID'
        ]);

        foreach ($requestOpenList as $requestOpen) {
            $user = User::where('id', $requestOpen->userID)->first();

            $facility = MassageFacility::where('id', $requestOpen->facilityID)->first();

            $requestOpen['username'] = $user->username;
            $requestOpen['facilityName'] = $facility->name;
        }

        return $requestOpenList;
    }

    public function requestActive() {
        $requestOpenList = CreateRequest::where('requestStatus', 1)->get([
            'id as requestID', 'facilityID', 'requestStatus as status', 'createdDate', 'userID'
        ]);

        foreach ($requestOpenList as $requestOpen) {
            $user = User::where('id', $requestOpen->userID)->first();

            $facility = MassageFacility::where('id', $requestOpen->facilityID)->first();

            $requestOpen['username'] = $user->username;
            $requestOpen['facilityName'] = $facility->name;
            $requestOpen['isActive'] = $facility->isActive;
        }

        return $requestOpenList;
    }

    public function requestAccept(Request $req) {
        $requestOpenFacility = CreateRequest::where('id', $req->requestID)->first();

        // trả về fail nếu quán đã được accept
        if($requestOpenFacility->requestStatus == 1) {
            return "fail";
        }

        $requestOpenFacility->requestStatus = 1;
        $requestOpenFacility->save();

        $massageFacility = MassageFacility::where('id', $requestOpenFacility->facilityID)->first();
        // return $massageFacility;
        $massageFacility->isActive = 1;
        $massageFacility->save();

        return "success";

    }

    public function requestDeny(Request $req) {
        $requestOpenFacility = CreateRequest::where('id', $req->requestID)->first();

        // trả về fail nếu quán đã được xét

        if($requestOpenFacility->requestStatus != 0) {
            return "fail";
        }

        $requestOpenFacility->requestStatus = 2;
        $requestOpenFacility->save();

        return "success";

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

    public function deactiveFacility(Request $req) {
        $facility = MassageFacility::where('id', $req->facilityID)->first();

        if($facility->isActive == 0) {
            return "fail";
        }
        $facility->isActive = 0;
        $facility->save();

        return "success";
    }

    public function activeFacility(Request $req) {
        $facility = MassageFacility::where('id', $req->facilityID)->first();

        if($facility->isActive == 1) {
            return "fail";
        }
        $facility->isActive = 1;
        $facility->save();

        return "success";
    }

    public function removeFacility(Request $req) {
        $facility = MassageFacility::where('id', $req->facilityID)->first();

        $facility->isActive = 0;
        $facility->save();

        $requestOpenFacility = CreateRequest::find($req->requestID);
        // return $requestOpenFacility;
        $requestOpenFacility->requestStatus = 2;
        $requestOpenFacility->save();

        return "success";
    }
}
