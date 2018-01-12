<?php

namespace OSD;

use Illuminate\Database\Eloquent\Model;

class Survey extends Model
{
   

	public function semestersurvey() {

        return $this->hasMany('OSD\Semester_Survey');

    }


    public function surveyquestion() {

        return $this->hasMany('OSD\Survey_Question');

    }


}
