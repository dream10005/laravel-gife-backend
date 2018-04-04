<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class UserActiveChallenges extends Model
{
    protected $primaryKey = "id";
    protected $table = "user_active_challenges";

    public static function activeChallenge($challenge_id, $user_id) {
        $result = UserActiveChallenges::insert([
            'user_id' => $user_id,
            'challenge_id' => $challenge_id,
            'created_at' => Carbon::now('Asia/Bangkok'),
            'updated_at' => Carbon::now('Asia/Bangkok')
        ]);
        return $result;
    }

    public static function getCompleteChallenges($user_id) {
        $result = UserActiveChallenges::join('challenges', 'user_active_challenges.challenge_id', '=', 'challenges.id')
                                        ->where('user_active_challenges.user_id', $user_id)
                                        ->where('user_active_challenges.active_challenge_status', 'done_has_gife')
                                        ->get();
        return $result;
    }

    public static function getReviewPendingChallenges($user_id) {
        $result = UserActiveChallenges::join('challenges', 'user_active_challenges.challenge_id', '=', 'challenges.id')
                                        ->where('user_active_challenges.user_id', $user_id)
                                        ->where('user_active_challenges.active_challenge_status', 'done_no_gife')
                                        ->get();
        return $result;
    }

    public static function getActiveChallenges($user_id) {
        $result = UserActiveChallenges::join('challenges', 'user_active_challenges.challenge_id', '=', 'challenges.id')
                                        ->where('user_active_challenges.user_id', $user_id)
                                        ->where('user_active_challenges.active_challenge_status', 'active')
                                        ->get();
        return $result;
    }
}
