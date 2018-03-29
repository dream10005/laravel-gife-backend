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

class UserController extends Controller
{   
    private $secretKey = 'rqBU7UgAU7VHRwCsVVgHtSBCwepsZbHa';

    public function getUserDetail(Request $request) {
        if(empty($request->header('token'))) {
            return response('missing token', 401);
        }
        try {
            DB::beginTransaction();
            $userId = JWT::decode($request->header('token'), $this->secretKey, array('HS256'));
            if($userId['success'] == false) {
                return response('unauthorized' ,401);
            }
            $response = Users::getUserDetail($userId);
            if(empty($response)) {
                return response('user not found', 401);
            }
        } catch(Exception $e) {
            DB::rollback();
            //$error = $e->getMessage;
            return response($e->getMessage(), 401);
        }   
        return response()-json($response);
    }
}