<?php

namespace OSD;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'name', 'surname', 'email', 'ci', 
    ];


     public function knowledge_area() {

        return $this->belongsTo('OSD\KnowledgeArea');
    }

   /* student_programming relation*/
    public function subject_programming() {
       return $this->belongsToMany('OSD\SubjectProgramming','student_programmings');
    }

   
    /*survey evaluation relation*/
    public function semester_survey() {
       return $this->belongsToMany('OSD\SemesterSurvey','survey_evaluations')->withPivot('date','description');
    }

    public function student_programming() {
       return $this->belongsToMany('OSD\StudentProgramming','survey_evaluations')->withPivot('date','description');
    }

}
