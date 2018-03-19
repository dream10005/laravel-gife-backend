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
}
