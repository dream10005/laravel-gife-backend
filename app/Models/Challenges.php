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
            'title' => "3rd test place",
            'rating' => 0,
            'location_label' => "3rd Place",
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

    public static function getSpotlightChallenges() {
        $result = Challenges::where('is_spotlight', TRUE)->get();
        return $result;
    }

    public static function getChallengeInSection($challengeSectionId) {
        $result = Challenges::where('challenge_section_id', $challengeSectionId)->get();
        return $result;
    }
}
