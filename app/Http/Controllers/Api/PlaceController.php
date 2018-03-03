<?php

namespace App\Http\Controllers\Api;

use App\Models\Places;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;

class PlaceController extends Controller
{

    public function addNewPlace(Request $request) {
        $response = Places::addNewPlace();
        return "sucess";
    }
    
    public function getPlaceDetail(Request $request) {
        $validator = Validator::make($request->all(), [
            'id' => 'required|integer',
        ]);
        if ($validator->fails()) {
            return response(null, 403);
        }
        try {
            $response = Places::getPlaceDetail($request->input('id'));
            if(empty($response)) {
                return response(null, 403);
            }
        } catch(Exception $e) {
            return response(null, 403);
        } 
        //return $response;
        return response()->json($response,200);
    }
    
}
