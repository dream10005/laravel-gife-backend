<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class ChallengeSections extends Model
{
    protected $primaryKey = "id";
    protected $table = "challenge_sections";

    public static function addNewChallengeSection($title, $desc = null) {
        $result = ChallengeSections::insert([
            'title' => $title,
            'short_description' => $desc,
            'created_at' => Carbon::now('Asia/Bangkok'),
            'updated_at' => Carbon::now('Asia/Bangkok')
        ]);
        return array($result);
    }
}
