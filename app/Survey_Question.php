<?php

namespace OSD;

use Illuminate\Database\Eloquent\Model;

class Survey_Question extends Model
{
    
    protected $fillable = [
        'description',
    ];



     public function answer() {

       return $this->hasMany('OSD\Survey_Answer');

    }


    public function surveyoptions() {

       return $this->hasMany('OSD\Survey_Options');

    }




}
