<?php

namespace App\Http\Controllers\Api;

require_once 'src/JWT.php';

use App\Models\Users;
use App\Models\OauthProfiles;
use App\Models\UserInvitations;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Firebase\JWT\JWT;
use Validator;
use DB;

class AuthController extends Controller
{   
    private $secretKey = 'rqBU7UgAU7VHRwCsVVgHtSBCwepsZbHa';

    public function generateInvitationCode() {
        $randomNumber = sprintf("%06d", mt_rand(1, 999999));
        $response = UserInvitations::hasInvitationCode($randomNumber);
        if(empty($response)) {
            $response = UserInvitations::insertInvitationCode($randomNumber);
            return response("success", 200); 
        }
        return response("error", 401);
    }

    public function verifyInvitationCode(Request $request) {
        $validator = Validator::make($request->all(), [
            'code' => 'required',
        ]);
        if ($validator->fails()) {
            return response(1, 401);
        }
        try {
            $response = UserInvitations::hasInvitationCode($request->input('code'));
            if(empty($response)) {
                return response(2, 401); 
            }
            $response = UserInvitations::activeInvitationCode($request->input('code'));
            if(empty($response)) {
                return response(3, 401);
            }
        } catch(Exception $e) {
           return response(4, 401);
        } 
        return response(null, 200);
    }

    public function login(Request $request) {
        $validator = Validator::make($request->all(), [
            'accessToken' => 'required|string',
            'uid' => 'required|integer'
        ]);
        if ($validator->fails()) {
            return response("input error", 403);
        }
        try {
            DB::beginTransaction();
            $hasUser = OauthProfiles::hasOauthProfile($request->input('uid'));
            if(empty($hasUser)) {
                $insertOauthProfiles = OauthProfiles::register($request->input('uid'), $request->input('accessToken'));
                if(empty($insertOauthProfiles)) {
                    return response(null, 403);
                } 
                $params = array(
                    'oauthProfileId' => $insertOauthProfiles,
                    'email' => $request->input('email') ?? '',
                    'firstName' => $request->input('first_name') ?? '',
                    'lastName' => $request->input('last_name') ?? '',
                    'imageUrl' => $request->input('image_url') ?? '',
                );
                $insertUsers = Users::register($params);
                if(empty($insertUsers)) {
                    return response(null, 403);
                }
                $payload['id'] = $insertUsers;
            } else {
                $payload['id'] = $hasUser->id;
                //Users::updateLastLogin();
            }
            DB::commit();
        } catch(Exception $e) {
            DB::rollback();
            return response("try catch error", 403);
        }
        $token = JWT::encode($payload, $this->secretKey);
        return response()->json([
            'token' => $token
        ]); 
    }

}
