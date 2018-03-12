<?php

namespace App\Http\Controllers\Api;

use App\Models\Places;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use Session;

class PlaceController extends Controller
{

    public function addNewPlace(Request $request) {
        $response = Places::addNewPlace($request->all());
        if(empty($response)) {
            return redirect('/error');
        } else {
            return redirect('/success');
        }
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
