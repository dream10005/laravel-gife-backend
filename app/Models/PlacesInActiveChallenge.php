<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class PlacesInActiveChallenge extends Model
{
    protected $primaryKey = "id";
    protected $table =  "places_in_active_challenge";
    
    public static function activePlace($place_id, $user_id) {
        $result = PlacesInActiveChallenge::insert([
            'user_id' => $user_id,
            'place_id' => $place_id,
            'created_at' => Carbon::now('Asia/Bangkok'),
            'updated_at' => Carbon::now('Asia/Bangkok')
        ]);
        return $result;
    }
}
