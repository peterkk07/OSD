<?php

namespace OSD;

use Illuminate\Database\Eloquent\Model;

class Semester extends Model
{
    protected $fillable = [
        'name', 'active',
    ];


    public function subject_programing() {

        return $this->hasMany('OSD\SubjectProgramming', 'semester_id');
    }

    public function semester_survey() {

        return $this->hasMany('OSD\SemesterSurvey', 'semester_id');
    }

}
