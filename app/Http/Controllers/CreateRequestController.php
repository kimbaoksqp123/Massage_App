<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\CreateRequest;
use Illuminate\Http\Request;

class CreateRequestController extends Controller
{
    public function store($massageFacilityID, $ownerID) {
        
        CreateRequest::create([
            'facilityID' => $massageFacilityID,
            'userID' => $ownerID,
            'requestStatus' => 1,
        ]);
    }
}
