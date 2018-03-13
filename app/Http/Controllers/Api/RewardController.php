<?php

namespace App\Http\Controllers\Api;

use App\Models\Rewards;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;

class RewardController extends Controller
{

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
    
}
