<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class OauthProfiles extends Model
{
    protected $primaryKey = "id";
    protected $table = "oauth_profiles";

    public static function hasOauthProfile($uid) {
        $result = OauthProfiles::select('id')->where('facebook_id', $uid)->first();
        return $result;
    }

    public static function register($uid, $accessToken) {
        $result = OauthProfiles::insertGetId([
            'facebook_id' => $uid,
            'access_token' => $accessToken,
            'created_at' => Carbon::now('Asia/Bangkok'),
            'updated_at' => Carbon::now('Asia/Bangkok'),
            'platform' => 'facebook',   
        ]);
        return $result;
    }
}
