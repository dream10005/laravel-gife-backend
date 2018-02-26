<?php

namespace App\Http\Controllers\Api;

use App\Models\Places;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;

class PlaceController extends Controller
{
    public function postAddNewPlace(Request $request) {
        $response = Places::addNewPlace();
        return "sucess";
    }
    
    public function getPlaceDetail(Request $request) {
        if(empty($request->input('place_id'))) {
            return response(null,403);
        }
        try {
            $response = Places::getPlaceDetail($request->input('place_id'));
        } catch(Exception $e) {
            return response(null,403);
        } 
        return $response;;
    }

}
