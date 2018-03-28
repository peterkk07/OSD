<?php

namespace OSD;

use Illuminate\Database\Eloquent\Model;

class SubjectProgramming extends Model
{
    

    public function studentprogram() {
        return $this->hasMany('OSD\subject_programming_id');
    }

     public function subject() {
       return $this->belongsTo('OSD\Subject', 'subject_id');
    }

    public function section() {
       return $this->belongsTo('OSD\Section', 'section_id');
    }

    public function semester() {
       return $this->belongsTo('OSD\Semester', 'semester_id');
    }

    public function teacher() {
       return $this->belongsTo('OSD\Teacher', 'teacher_id');
    }


}
