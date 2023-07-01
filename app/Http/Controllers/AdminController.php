<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\CreateRequest;
use App\Models\User;
use App\Models\MassageFacility;



class AdminController extends Controller
{
    public function search(Request $request) {
    }

    public function request() {
        $requestOpenList = CreateRequest::get([
            'id as requestID', 'facilityID', 'requestStatus as status', 'createdDate', 'userID'
        ]);

        foreach ($requestOpenList as $requestOpen) {
            $user = User::where('id', $requestOpen->userID)->first();
            // return $user;
            $requestOpen['username'] = $user->username;
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
}
