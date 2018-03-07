<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Challenges extends Model
{
    protected $primaryKey = "id";
    protected $table = "challenges";

    public static function addNewChallenge() {
        $result = Challenges::insert([
            'challenge_duration_id' => 1,
            'title' => "1st test place",
            'rating' => 0,
            'location_label' => "Sample Place",
            'banner_image_url' => 'sss',
            'reward_type_id' => 1,
            'start_date' => Carbon::now('Asia/Bangkok'),
            'created_at' => Carbon::now('Asia/Bangkok'),
            'updated_at' => Carbon::now('Asia/Bangkok')
        ]);
        return array($result);
    }

    public static function getChallengeDetail($id) {
        $result = Challenges::where('id', $id)->first();
        return $result;
    }

}
