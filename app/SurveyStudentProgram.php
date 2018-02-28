<?php

namespace OSD;

use Illuminate\Database\Eloquent\Model;

class SurveyStudentProgram extends Model
{
     public function student() {

       return $this->belongsTo('OSD\Student');

    }


     public function subjectprogramming() {

       return $this->belongsTo('OSD\SubjectProgramming');

    }


    public function surveyevaluation() {

        return $this->hasMany('OSD\SurveyEvaluation');

    }


}