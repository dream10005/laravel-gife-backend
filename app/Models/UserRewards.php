<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class UserRewards extends Model
{
    protected $primaryKey = "id";
    protected $table =  "user_rewards";

    public static function insert($userId, $rewardId) {
        $result = UserRewards::insert([
            'user_id' => $userId,
            'reward_id' => $rewardId,
            'created_at' => Carbon::now('Asia/Bangkok'),
            'updated_at' => Carbon::now('Asia/Bangkok'),
        ]);
        return $result;
    }
}
