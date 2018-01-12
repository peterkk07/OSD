<?php

namespace OSD;

use Illuminate\Database\Eloquent\Model;

class Subject_Programming extends Model
{
    

    public function studentprogram() {

        return $this->hasMany('OSD\SurveyStudent_Programming');

    }


     public function subject() {

       return $this->belongsTo('OSD\Subject');

    }

    public function section() {

       return $this->belongsTo('OSD\Section');

    }


    public function semester() {

       return $this->belongsTo('OSD\Semester');

    }

    public function teacher() {

       return $this->belongsTo('OSD\Teacher');

    }


}
