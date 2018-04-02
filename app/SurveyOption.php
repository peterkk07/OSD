<?php

namespace OSD;

use Illuminate\Database\Eloquent\Model;

class SurveyOption extends Model
{
    
	protected $fillable = [
        'description',
    ];

    public function survey_question() {

       return $this->belongsTo('OSD\SurveyQuestion');
    }


  /* survey_answers relation pivot*/

    public function survey_answer() {
       
       return $this->belongsToMany('OSD\SurveyAnswer','survey_answers');
    }

    public function survey_evaluation() {
       
       return $this->belongsToMany('OSD\SurveyEvaluation','survey_answers');
    }


    

    
}


