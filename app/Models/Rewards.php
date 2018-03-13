<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Rewards extends Model
{
    protected $primaryKey = "id";
    protected $table =  "rewards";

    public static function addNewReward($params) {
        $result = Rewards::insert([
            'reward_type_id' => 1,
            'title' => $params['title'],
            'description' => $params['reward_desc'],
            'external_url' => $params['external_url'],
            'banner_image_url' => $params['image_url'],
            'required_gife_points' => $params['required_points'],
            'usage_limit' => 100,
            'start_date' => Carbon::now('Asia/Bangkok'),
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
