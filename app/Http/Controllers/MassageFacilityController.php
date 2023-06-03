<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\MassageFacilityResource;
use App\Models\MassageFacility;
use App\Models\MassageService;
use Illuminate\Http\Request;

class MassageFacilityController extends Controller
{
    public function index() {
        return MassageFacilityResource::collection(MassageFacility::all());
    }

    public function filter(Request $req) {

        $input = $req->input;
        $serviceList = $req->serviceList;
        $minPrice = $req->minPrice;
        $maxPrice = $req->maxPrice;
        $minRate = $req->minRate;
        $maxRate = $req->maxRate;

        $query = MassageFacility::query();

        // name, address
        if ($input) {
            $query->where('name', 'like', "%{$input}%")
                ->orWhere('location', 'like', "%{$input}%");
        }

        // massage service
        if ($serviceList && count($serviceList) > 0) {
            
        }

        // price
        if ($minPrice && $maxPrice) {
            $facilitySearchIds = MassageService::where('price', '>=', $minPrice)->where('price', '<=', $maxPrice)->pluck('id')->toArray();
            $query->whereIn('id', $facilitySearchIds);
        }

        // rate
        if ($minRate && $maxRate) {

        }

        return MassageFacilityResource::collection($query->get());
    }

    public function detail($id) {
        return MassageFacility::find($id);
    }
}
