<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Places extends Model
{
    protected $primaryKey = "id";
    protected $table =  "places";

    public static function addNewPlace() {
        $result = Places::insert([
            'id' => 1,
            'subregion_id' => 1,
            'type_id' => 1,
            'title' => "1st test place",
            'about' => "Sample Place",
            'latitude' => 101.11,
            'longitude' => 33.22,
            'banner_image_url' => 'sss',
            'contact_info' => 1,
            'open_close_time' => 1,
            'price_range_min' => 1,
            'price_range_max' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        return array($result);
    }

    public static function getPlaceDetail($place_id) {
        $result = Places::find($place_id)
                        ->first();
        return $result;
    }
}
