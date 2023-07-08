<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{
    public function register(Request $request)
    {

        User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password), // password
            'phoneNumber' => $request->phoneNumber,
            'fullname' => $request->name,
            'age' => $request->age,
            'gender' => $request->gender,
            'userType' => 0,
        ]);
    }

    public function login(Request $request)
    {
        $user = User::where('email', $request->email)->first();

        // return $user;
        if (!$user || !Hash::check($request->password, $user->password, [])) {
            return [
                'userID' => -1,
            ];
        }

        $token = $user->createToken('authToken')->plainTextToken;

        $returnData = [
            'accessToken' => $token,
            'type_token' => 'Bearer',
        ];

        if ($user->userType == 0) {
            $returnData['userType'] = 'user';
        } elseif ($user->userType == 1) {
            $returnData['userType'] = 'owner';
        } else {
            $returnData['userType'] = 'admin';
        }

        return $returnData;
    }

    public function user(Request $request)
    {
        $getUserByToken = $request->user();

        return [
            'userID' => $getUserByToken->id,
            'userName' => $getUserByToken->username,
            'userAvatar' => asset($getUserByToken->avatarImageUrl),
            'data' => $request->data,
        ];
    }


    public function logout()
    {
        // Revoke all tokens...
        // auth()->user()->tokens()->delete();

        // Revoke the token that was used to authenticate the current request...
        auth()->user()->currentAccessToken()->delete();

        // Revoke a specific token...
        // $user->tokens()->where('id', $tokenId)->delete();
        return [
            'status' => 'success'
        ];
    }
}
