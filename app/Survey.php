<?php

namespace OSD;

use Illuminate\Database\Eloquent\Model;

class Survey extends Model
{
   
    public function semester() {
       return $this->belongsToMany('OSD\Semester','semester_surveys')->withPivot('active','start_date','end_date');
    }

    public function question() {
        return $this->hasMany('OSD\SurveyQuestion', 'survey_question');
    }  

}
