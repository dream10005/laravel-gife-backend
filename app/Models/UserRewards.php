<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class UserRewards extends Model
{
    protected $primaryKey = "id";
    protected $table =  "user_rewards";

    public static function claimReward($userId, $rewardId) {
        $result = UserRewards::insert([
            'user_id' => $userId,
            'reward_id' => $rewardId,
            'created_at' => Carbon::now('Asia/Bangkok'),
            'updated_at' => Carbon::now('Asia/Bangkok')
        ]);
        return $result;
    }

    public static function getClaimRewards($userId) {
        $result = UserRewards::join('rewards', 'rewards.id', '=', 'user_rewards.reward_id')
                            ->where('user_rewards.user_id', $userId)
                            ->get();
        return $result;
    }
}
