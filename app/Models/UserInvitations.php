<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserInvitations extends Model
{
    protected $primaryKey = "id";
    protected $table =  '"user"'.'.user_invitations';

    public static function insertInvitationCode($code, $userId) {
        $result = UserInvitations::insert([
            'code' => $code,
            'user_id' => $userId
        ]);
        return $result;
    }

    public static function hasInvitationCode($code) {
        $result = UserInvitations::select('code')
                                ->where('code', $code)
                                ->first();
        return $result;
    }
}
