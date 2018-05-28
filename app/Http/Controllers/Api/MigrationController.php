<?php

namespace App\Http\Controllers\Api;

use App\Models\ChallengeSections;
use App\Models\Challenges;
use App\Models\Places;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use DB;

class MigrationController extends Controller {   
    
    private function handleExceptionWithMsg($request, $e="", $msg="") {
        return array(
            'error' => $msg,
            'message' => $e->getMessage()
        );
    }

    private function csvToArray($filename = '', $delimiter = ',') {
	    $header = null;
	    $data = array();
	    if (($handle = fopen($filename, 'r')) !== false) {
	        while (($row = fgetcsv($handle, 10000, $delimiter)) !== false) {
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

    public function uploadPlaces(Request $request) {
        DB::beginTransaction();
    	$path = $request->file('csv')->getRealPath();
        $rows = $this->csvToArray($path);
        try {
            foreach($rows as $row) {
                $data = array(
                    'type_id' => 1,
                    'title' => $row['title'],
                    'subregion_id' => 1,
                    'banner_image_url' => $row['banner_image_url'],
                    'about' => $row['Detail'],
                    'open_close_time' => $row['open_close_time'],
                    'latitude' => $row['Latitude'],
                    'longitude' => $row['Longtitude'],
                    'price_range_min' => $row['price_range_min'],
                    'price_range_max' => $row['price_range_max'],
                    'review_url' => $row['review_url'],
                    'address_description' => $row['address_description']
                );
                $insert = DB::connection('gife_stag')->table('places')->insert($data);
            }
            $result = array(
                'success' => true
            );
            DB::commit();
        }catch(\Exception $e) {
            DB::rollback();
            $result = $this->handleExceptionWithMsg($request, $e, "Update error");
        }
        return $result;
    }

    public function uploadRewards(Request $request) {
        DB::beginTransaction();
    	$path = $request->file('csv')->getRealPath();
        $rows = $this->csvToArray($path);
        try {
            foreach($rows as $row) {
                $data = array(
                    'title' => $row['title'],
                    'banner_image_url' => $row['banner_image_url'],
                    'required_gife_points' => $row['gife_point'],
                    'usage_limit' => 100
                );
                $insert = DB::connection('gife_stag')->table('rewards')->insert($data);
            }
            $result = array(
                'success' => true
            );
            DB::commit();
        }catch(\Exception $e) {
            DB::rollback();
            $result = $this->handleExceptionWithMsg($request, $e, "Update error");
        }
        return $result;
    }
}