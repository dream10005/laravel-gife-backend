<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Users extends Model
{
    protected $primaryKey = "id";
    protected $table =  "users";

    public static function register($oauthProfileId) {
        $result = Users::insertGetId([
            'oauth_profile_id' => $oauthProfileId,
            'created_at' => Carbon::now('Asia/Bangkok'),
            'updated_at' => Carbon::now('Asia/Bangkok'),
            'last_login_at' => Carbon::now('Asia/Bangkok'),
        ]);
        return $result;
    }

    public static function getUserDetail($userId) {
        $result = Users::select(
            'gife_points',
            'completed_gifes_count',
            'completed_challenges_count',
            'completed_places_count',
            'image_url',
            'email'
        )->where('id', $userId)
        ->first();

        return $result;
    }

}
