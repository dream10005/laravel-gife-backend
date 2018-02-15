<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class PlaceController extends Controller
{
    public function getPlaceDetailById(Request $request) {
        if(!$request->has('place_id')) {
            return response()->json([
                'success' => false,
                'message' => 'NO_INPUT'
            ],500);
        }
        try {
            $result = DB::connection('gifebeta')
                        ->table('Places')
                        ->where('id', $request->input('place_id'))
                        ->first();
            if(!$result) {
                return response()->json([
                    'success' => false,
                    'message' => 'GET_DETAIL_ERROR'
                ],500);
            }
        } catch(Exception $e){
			$this->handleExceptionWithMsg($request, $e, "Get place detail error");
        }
        return response()->json([
            'success'   =>  true,
            'result'    =>  $result,
        ]);
    }

}
