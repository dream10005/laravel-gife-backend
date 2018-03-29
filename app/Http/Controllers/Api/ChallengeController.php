<?php

namespace App\Http\Controllers\Api;

require_once 'src/JWT.php';
require_once 'src/SignatureInvalidException.php';

use App\Models\PlacesInActiveChallenge;
use App\Models\UserActiveChallenges;
use App\Models\ChallengeSections;
use App\Models\Challenges;
use App\Models\Places;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Firebase\JWT\JWT;
use Firebase\JWT\SignatureInvalidException;
use Validator;
use DB;

class ChallengeController extends Controller
{
    private $secretKey = 'rqBU7UgAU7VHRwCsVVgHtSBCwepsZbHa';

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
        try {
            $spotlightResp = Challenges::getSpotlightChallenges();
            $sectionChallengeResp = ChallengeSections::getSectionChallenges();
            $nearbyResp = Places::getNearByPlaces();
            $result = array(
                'spotlight' => $spotlightResp ?? '',
                'sections' => $sectionChallengeResp ?? '',
                'nearby' => $nearbyResp ?? ''
            );
        } catch(Exception $e) {
            return response(null, 403);
        }
        return response()->json($result, 200);
    }
    
    public function startChallenge(Request $request) {
        $validator = Validator::make($request->all(), [
            'placeId' => 'required|integer',
            'challengeId' => 'required|integer'
        ]);
        if ($validator->fails()) {
            return response('missing input/wrong input type', 403);
        }
        if(empty($request->header('token'))) {
            return response('missing token', 401);
        }
        try {
            DB::beginTransaction();
            $userId = JWT::decode($request->header('token'), $this->secretKey, array('HS256'));
            if($userId['success'] == false) {
                return response('unauthorized' ,401);
            }
            $response = UserActiveChallenges::activeChallenge($request->input('challengeId'), $userId->id);
            if(empty($response)) {
                DB::rollback();
                return response(null, 403);
            }
            $response = PlacesInActiveChallenge::activePlace($request->input('placeId'), $userId->id);
            if(empty($response)) {
                DB::rollback();
                return response(null, 403);
            }
        } catch(Exception $e) {
            DB::rollback();
            //$error = $e->getMessage;
            return response(null, 403);
        }
        DB::commit();
        return response()->json(null, 200);
    }

}
