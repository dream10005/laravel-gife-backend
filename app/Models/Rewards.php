<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Rewards extends Model
{
    protected $primaryKey = "id";
    protected $table =  "rewards";

    public static function addNewReward() {
        $result = Rewards::insert([
            'reward_type_id' => 1,
            'title' => "1st test reward",
            'description' => "Sample Reward",
            'usage_limit' => 100,
            'start_date' => Carbon::now('Asia/Bangkok'),
            'end_date' => Carbon::now('Asia/Bangkok'),
            'created_at' => Carbon::now('Asia/Bangkok'),
            'updated_at' => Carbon::now('Asia/Bangkok')
        ]);
        return array($result);
    }

    public static function getRewardDetail($id) {
        $result = Rewards::where('id', $id)->first();
        return $result;
    }
}
