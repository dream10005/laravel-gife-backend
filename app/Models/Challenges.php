<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Challenges extends Model
{
    protected $primaryKey = "id";
    protected $table = "challenges";

    public static function addNewChallenge($params) {
        $result = Challenges::insert([
            'challenge_section_id' => 1,
            'challenge_duration_id' => 1,
            'title' => $params['title'],
            'rating' => 0,
            'location_label' => $params['location_label'],
            'banner_image_url' => $params['image_url'],
            'reward_gife_points' => $params['reward_points'],
            'reward_type_id' => 1,
            'goal_description' => $params['goal_desc'],
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

    public static function getHistory($userId) {
        $result = Challenges::where('user_id', $userId)->get();
        return $result;
    }

    public static function getReviewPendingChallenges($userId) {
        $result = Challenges::where('user_id', $userId)->get();
        return $result;
    }
}
