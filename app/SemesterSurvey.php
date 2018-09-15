<?php

namespace OSD;

use Illuminate\Database\Eloquent\Model;

class SemesterSurvey extends Model
{
     protected $fillable = [
        'status', 'start_date', 'end_date',
    ];

 
    public function survey() {

       return $this->belongsTo('OSD\Survey','survey_id');
    }


    public function student() {

       return $this->belongsTo('OSD\Student','survey_evaluations');
    }

    public function student_programming() {

       return $this->belongsTo('OSD\StudentProgramming','survey_evaluations');
    }
}
