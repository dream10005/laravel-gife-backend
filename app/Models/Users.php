<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Users extends Model
{
    protected $primaryKey = "id";
    protected $table =  "users";

    public static function register($params) {
        $result = Users::insertGetId([
            'oauth_profile_id' => $params['oauthProfileId'],
            'created_at' => Carbon::now('Asia/Bangkok'),
            'updated_at' => Carbon::now('Asia/Bangkok'),
            'last_login_at' => Carbon::now('Asia/Bangkok'),
            'email' => $params['email'],
            'first_name' => $params['firstName'],
            'last_name' => $params['lastName'],
            'image_url' => $params['imageUrl']
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
            'email',
            'first_name',
            'last_name'
        )->where('oauth_profile_id', $userId)
        ->first();

        return $result;
    }

    public static function updateLastLogin($oauthProfileId) {
        $result = User::update([
            'last_login_at' => Carbon::now('Asia/Bangkok'),
        ])->where('oauth_profile_id', $oauthProfileId);
    }

}
