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
        
    }
}
