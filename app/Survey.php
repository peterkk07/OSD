<?php

namespace OSD;

use Illuminate\Database\Eloquent\Model;

class Survey extends Model
{
   
    protected $fillable = [
        'name', 
    ];

    public function semester() {
       return $this->belongsToMany('OSD\Semester','semester_surveys')->withPivot('status','start_date','end_date');
    }

  /* pregunta-encuesta*/
    public function question() {

        return $this->belongsToMany('OSD\Question','survey_questions')->withPivot('description');
    
    }  

}
