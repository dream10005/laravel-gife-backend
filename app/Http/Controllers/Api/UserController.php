<?php

namespace App\Http\Controllers\Api;

require_once 'src/JWT.php';

use App\Models\Users;
use App\Models\Rewards;
use App\Models\Challenges;
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
            $decryptToken = JWT::decode($request->header('token'), $this->secretKey, array('HS256'));
            if(empty($decryptToken)) {
                return response('unauthorized' ,401);
            }
            $userId = $decryptToken->id;
            $userDetail = Users::getUserDetail($userId);
            if(empty($userDetail)) {
                return response('user not found', 401);
            }
            $result = $userDetail;
            // $activeChallenge = Challenges::getActiveChallenges();
            // $reviewPendingChallenge = Challenges::getReviewPendingChallenges();
            // $historyChallenges = Challenges::getHistory();
            // $historyRewards = Rewards::getHistory();
        } catch(Exception $e) {
            return response($e->getMessage(), 401);
        }   
        return response()->json($result, 200);
    }
}