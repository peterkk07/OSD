<?php

namespace OSD;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'name', 'surname', 'email', 'ci', 
    ];


    public function student_programing() {

        return $this->hasMany('OSD\StudentProgramming', 'student_id');
    }

    public function survey_evaluation() {

        return $this->hasMany('OSD\SurveyEvaluation', 'student_id');
    }
}
