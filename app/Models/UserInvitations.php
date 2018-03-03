<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class UserInvitations extends Model
{
    protected $primaryKey = "id";
    protected $table =  "user_invitation";

    public static function insertInvitationCode($code) {
        $result = UserInvitations::insert([
            'code' => $code,
            'created_at' => Carbon::now('Asia/Bangkok'),
            'updated_at' => Carbon::now('Asia/Bangkok')
        ]);
        return array($result);
    }

    public static function hasInvitationCode($code) {
        $result = UserInvitations::select('code')
                                ->where('code', $code)
                                ->first();
        return $result;
    }

    public static function activeInvitationCode($code) {
        $result = UserInvitations::where('code', $code)
                                ->update([
                                    'is_active' => 1,
                                    'updated_at' => Carbon::now('Asia/Bangkok')
                                ]);
        return $result;
    }
}
