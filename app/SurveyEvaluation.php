<?php

namespace OSD;

use Illuminate\Database\Eloquent\Model;

class Survey_Evaluation extends Model
{
    
	 public function survey_answer() {

        return $this->hasMany('OSD\SurveyAnswer');

    }


     public function studentprogram() {

       return $this->belongsTo('OSD\SurveyStudentProgram');

    }

     public function student() {

       return $this->belongsTo('OSD\SurveyStudent');

    }



}
