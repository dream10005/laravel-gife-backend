<?php

namespace App\Http\Controllers\Api;

use App\Models\UserInvitations;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use DB;

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
            $connectDatabase = UserInvitations::test();
            $a = $request->input('code');
            if( $connectDatabase != "connected"){ 
                return "error";
            }
        } catch(Exception $e) {
           return response(null,401);
        }
        
        return $a;
    }
}
