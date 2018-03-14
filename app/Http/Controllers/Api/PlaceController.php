<?php

namespace App\Http\Controllers\Api;

use App\Models\Places;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use Session;
use DB;
use Redirect;

class PlaceController extends Controller
{
    private function csvToArray($filename = '', $delimiter = ',') {
	    $header = null;
	    $data = array();
	    if (($handle = fopen($filename, 'r')) !== false) {
	        while (($row = fgetcsv($handle, 1000, $delimiter)) !== false) {
	            if (!$header) {
                    $header = $row;
                } else {
                    $data[] = array_combine($header, $row);
                }
	        }
	        fclose($handle);
	    }
	    return $data;
    }
    
    public function addPlaceByCSV(Request $request) {
        try {
            DB::beginTransaction();
            $path = $request->file('csv')->getRealPath();
            $rows = $this->csvToArray($path);
            foreach($rows as $row) {
                $response = Places::addNewPlace($row);
                if($response == false) {
                    DB::rollback();
                    //return Redirect::route('place_error', array('errorResp' => 'error on row no.'.$row_count));
                    return redirect('/place_error1');
                }
            }
        } catch(\Exception $e) {
            DB::rollback();
            return redirect('/place_error2');
        }
        DB::commit();
        return redirect('/place_success');
    }

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
