<?php

namespace OSD;

use Illuminate\Database\Eloquent\Model;

class Survey extends Model
{
   

	public function semestersurvey() {

        return $this->hasMany('OSD\SemesterSurvey');

    }


    public function surveyquestion() {

        return $this->hasMany('OSD\SurveyQuestion');

    }


}
