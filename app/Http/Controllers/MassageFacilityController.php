<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\MassageFacilityResource;
use App\Models\MassageFacility;
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

        }

        // rate
        if ($minRate && $maxRate) {

        }

        return MassageFacilityResource::collection($query->get());
    }
}
