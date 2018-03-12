<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Places extends Model
{
    protected $primaryKey = "id";
    protected $table =  "places";

    public static function addNewPlace($params) {
        $result = Places::insert([
            'subregion_id' => 1,
            'type_id' => $params['type_id'],
            'title' => $params['title'],
            'rating' => 0,
            'about' => $params['about'],
            'latitude' => $params['latitude'],
            'longitude' => $params['longitude'],
            'banner_image_url' => $params['image_url'],
            'address_description' => $params['address_desc'],
            'contact_info' => $params['contact'],
            'open_close_time' => $params['time'],
            'price_range_min' => $params['price_min'],
            'price_range_max' => $params['price_max'],
            'created_at' => Carbon::now('Asia/Bangkok'),
            'updated_at' => Carbon::now('Asia/Bangkok')
        ]);
        return array($result);
    }

    public static function getPlaceDetail($id) {
        $result = Places::where('id', $id)->first();
        return $result;
    }
}
