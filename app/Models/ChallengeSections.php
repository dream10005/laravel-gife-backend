<?php

namespace App\Models;

use App\Models\Challenges;
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

    public static function getSectionChallenges() {
        $sections = ChallengeSections::select('id', 'title')->get();
        $result = array();
        foreach($sections as $section) {
            $challengesInSection = Challenges::getChallengeInSection($section->id);
            $sectionDetail = array(
                'title' => $section->title,
                'sectionId' => $section->id,
                'challenges' => $challengesInSection
            );
            array_push($result, $sectionDetail);
        }
        return $result;
    }
}
