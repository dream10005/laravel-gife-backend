<?php

namespace App\Http\Controllers\Api;

require_once 'src/JWT.php';

use App\Models\Rewards;
use App\Models\UserRewards;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Firebase\JWT\JWT;
use Validator;
use DB;

class RewardController extends Controller
{
    private $secretKey = 'rqBU7UgAU7VHRwCsVVgHtSBCwepsZbHa';

    public function addNewReward(Request $request) {
        $response = Rewards::addNewReward($request->all());
        if(empty($response)) {
            return redirect('/reward_error');
        } else {
            return redirect('/reward_success');
        }
    }
    
    public function getRewardDetail(Request $request) {
        $validator = Validator::make($request->all(), [
            'id' => 'required|integer',
        ]);
        if ($validator->fails()) {
            return response(null, 403);
        }
        try {
            $response = Rewards::getRewardDetail($request->input('id'));
            if(empty($response)) {
                return response(null, 403);
            }
        } catch(Exception $e) {
            return response(null, 403);
        } 
        return response()->json($response,200);
    }

    public function getRewardList(Request $request) {
       try {
           $spotlightResp = Rewards::getSpotlightRewards();
           $rewardResp = Rewards::getRewardLists();
           $result = array(
            'spotlight' => $spotlightResp ?? '',
            'rewards' => $rewardResp ?? '',
           );
       } catch(Exception $e) {
            return response(null, 403);
       }
       return response()->json($result, 200);
    }

    public function claimReward(Request $request) {
        $validator = Validator::make($request->all(), [
            'rewardId' => 'required',
        ]);
        if ($validator->fails()) {
            return response(null, 403);
        }
        if(empty($request->header('token'))) {
            return response(null, 401);
        }
        try {
            DB::beginTransaction();
            $decryptToken = JWT::decode($request->header('token'), $this->secretKey, array('HS256'));
            if(empty($decryptToken)) {
                return response(null, 401);
            }
            $response = UserRewards::claimReward($decryptToken->id, $request->input('rewardId'));
            if(empty($response)) {
                DB::rollback();
                return response(null, 403);
            }
        } catch(Exception $e) {
            DB::rollback();
            return response(null, 403);
        }
        DB::commit();
        return response(null ,200);
    }
    
}
