<?php

namespace App\Http\Controllers\Api;

use App\Models\UserInvitations;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;

class AuthController extends Controller
{   
    // private $errorMessages = array(
    //     'required' => 'Missing :attribute',
    //     'integer' => 'Invalid :attribute',
    //     'string' => 'Invalid :attribute',
    //     'max' => 'Invalid length'
    // );
    // private $rules = array(
    //     'code' => 'required|string',
    // ); 
    public function test() {
        $response = UserInvitations::insertInvitationCode('test', '1');
        return $response;
    }

    public function verifyInvitationCode(Request $request) {
        if(empty($request->input("code"))) {
            return response(null,401);
        }
        try {
            $response = UserInvitations::hasInvitationCode($request->input("code"));
            if(empty($response)) {
                return response(null,401); 
            }
        } catch(Exception $e) {
           return response(null,401);
        } 
        return response(null,200);
    }
}
