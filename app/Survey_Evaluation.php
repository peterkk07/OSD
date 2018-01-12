<?php

namespace OSD;

use Illuminate\Database\Eloquent\Model;

class Survey_Evaluation extends Model
{
    
	 public function survey_answer() {

        return $this->hasMany('OSD\Survey_Answer');

    }


     public function studentprogram() {

       return $this->belongsTo('OSD\SurveyStudent_Program');

    }

     public function student() {

       return $this->belongsTo('OSD\SurveyStudent');

    }



}
