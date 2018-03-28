<?php

namespace OSD;

use Illuminate\Database\Eloquent\Model;

class SurveyOption extends Model
{
    
	protected $fillable = [
        'description',
    ];

    public function answer() {

       return $this->hasMany('OSD\SurveyAnswer', 'survey_option_id');

    }

     public function surveyquestion() {

       return $this->belongsTo('OSD\SurveyQuestion', 'survey_question_id');

    }
}
