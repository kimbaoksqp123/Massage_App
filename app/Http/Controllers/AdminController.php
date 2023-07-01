<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\CreateRequest;
use App\Models\User;


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
}
