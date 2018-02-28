<?php

namespace OSD;

use Illuminate\Database\Eloquent\Model;

class Survey_Options extends Model
{
    


    public function answer() {

       return $this->hasMany('OSD\SurveyAnswer');

    }

     public function surveyquestion() {

       return $this->belongsTo('OSD\SurveyQuestion');

    }
}
