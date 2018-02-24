<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class UserInvitations extends Model
{
    protected $primaryKey = "id";
    protected $table =  "user_invitation";

    public static function insertInvitationCode($code, $userId) {
        $result = UserInvitations::insert([
            'id' => 1,
            'code' => $code,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        return array($result);
    }

    public static function hasInvitationCode($code) {
        $result = UserInvitations::select('code')
                                ->where('code', $code)
                                ->first();
        return $result;
    }
}
