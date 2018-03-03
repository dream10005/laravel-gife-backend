<?php

namespace App\Http\Controllers\Api;

use App\Models\UserInvitations;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;

class AuthController extends Controller
{   
    public function generateInvitationCode() {
        $randomNumber = sprintf("%06d", mt_rand(1, 999999));
        $response = UserInvitations::hasInvitationCode($randomNumber);
        if(empty($response)) {
            $response = UserInvitations::insertInvitationCode($randomNumber);
            return response("success",200); 
        }
        return response("error",401);
    }

    public function verifyInvitationCode(Request $request) {
        if(empty($request->input("code"))) {
            return response(null,401);
        }
        try {
            $response = UserInvitations::hasInvitationCode($request->input('code'));
            if(empty($response)) {
                return response(null,401); 
            }
            $response = UserInvitations::activeInvitationCode($request->input('code'));
            if(empty($response)) {
                return response(null,401);
            }
        } catch(Exception $e) {
           return response(null,401);
        } 
        return response(null,200);
    }
}
