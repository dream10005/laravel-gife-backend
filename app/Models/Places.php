<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use DB;

class Places extends Model
{
    protected $primaryKey = "id";
    protected $table =  "places";

    public static function addNewPlace($params) {
        DB::beginTransaction();
        $result = Places::insert([
            'subregion_id' => 1,
            'type_id' => 1,
            'title' => $params['title'],
            'rating' => 0,
            'about' => $params['about'],
            'latitude' => $params['latitude'],
            'longitude' => $params['longitude'],
            'banner_image_url' => $params['banner_image_url'],
            'review_url' => $params['review_url'],
            'address_description' => $params['address_description'],
            'contact_info' => $params['contact_info'],
            'open_close_time' => $params['open_close_time'],
            'price_range_min' => $params['price_range_min'],
            'price_range_max' => $params['price_range_max'],
            'created_at' => Carbon::now('Asia/Bangkok'),
            'updated_at' => Carbon::now('Asia/Bangkok')
        ]);
        if(empty($result)) {
            DB::rollback();
            return false; 
        }
        DB::commit();
        return true;
    }

    public static function getPlaceDetail($id) {
        $result = Places::where('id', $id)->first();
        return $result;
    }

    public static function getNearByPlaces() {
        $result = Places::orderBy('id', 'asc')->get();
        return $result;
    }
}
