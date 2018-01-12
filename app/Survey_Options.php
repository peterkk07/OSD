<?php

namespace OSD;

use Illuminate\Database\Eloquent\Model;

class Survey_Options extends Model
{
    


    public function answer() {

       return $this->hasMany('OSD\Survey_Answer');

    }

     public function surveyquestion() {

       return $this->belongsTo('OSD\Survey_Question');

    }
}
