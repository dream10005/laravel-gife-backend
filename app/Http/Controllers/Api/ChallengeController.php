<?php

namespace App\Http\Controllers\Api;

use App\Models\ChallengeSections;
use App\Models\Challenges;
use App\Models\Places;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;

class ChallengeController extends Controller
{
    public function addNewChallenge(Request $request) {
        $response = Challenges::addNewChallenge($request->all());
        if(empty($response)) {
            return redirect('/challenge_error');
        } else {
            session()->put('test', 'test');
            session()->save();
            return redirect('/challenge_success');
        }
    }
    
    public function getChallengeDetail(Request $request) {
        $validator = Validator::make($request->all(), [
            'id' => 'required|integer',
        ]);
        if ($validator->fails()) {
            return response(null, 403);
        }
        try {
            $response = Challenges::getChallengeDetail($request->input('id'));
            if(empty($response)) {
                return response(null, 403);
            }
        } catch(Exception $e) {
            return response(null, 403);
        } 
        //return $response;
        return response()->json($response,200);
    }

    public function addNewChallengeSection(Request $request) {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
        ]);
        if ($validator->fails()) {
            return response(null, 403);
        }
        $response = ChallengeSections::addNewChallengeSection($request->input('title'));
        return $response;
    }

    public function getExplore(Request $request) {
        $spotlightResp = Challenges::getSpotlightChallenges();
        $sectionChallengeResp = ChallengeSections::getSectionChallenges();
        //$nearbyResp = Places::getNearBy();
        $result = array(
            'spotlight' => $spotlightResp,
            'sections' => $sectionChallengeResp,
            'nearby' => 'not avaliable now'
        );
        return response()->json($result);
    }
    
}
