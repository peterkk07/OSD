<?php

namespace OSD;

use Illuminate\Database\Eloquent\Model;

class SurveyStudent_Program extends Model
{
     public function student() {

       return $this->belongsTo('OSD\Student');

    }


     public function subjectprogramming() {

       return $this->belongsTo('OSD\Subject_Programming');

    }


    public function surveyevaluation() {

        return $this->hasMany('OSD\Survey_Evaluation');

    }


}
