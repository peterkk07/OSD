<?php

namespace OSD;

use Illuminate\Database\Eloquent\Model;

class Survey_Question extends Model
{
    
    protected $fillable = [
        'description',
    ];


     public function answer() {

       return $this->hasMany('OSD\SurveyAnswer', 'survey_question_id');

    }

    public function survey_options() {

       return $this->hasMany('OSD\SurveyOptions', 'survey_question_id');

    }

}
