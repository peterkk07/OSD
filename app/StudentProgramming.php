<?php

namespace OSD;

use Illuminate\Database\Eloquent\Model;

class StudentProgramming extends Model
{
    public function student() {

       return $this->belongsTo('OSD\Student', 'student_id');
    }


    public function subject_programming() {

       return $this->belongsTo('OSD\SubjectProgramming', 'subject_programming_id');
    }
  

}