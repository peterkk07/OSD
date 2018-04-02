<?php

namespace OSD;

use Illuminate\Database\Eloquent\Model;

class Semester extends Model
{
    protected $fillable = [
        'name', 'active',
    ];

    /*Subject_programmings relation*/
    public function subject() {
       return $this->belongsToMany('OSD\Subject','subject_programmings');
    }

    public function teacher() {
       return $this->belongsToMany('OSD\Teacher','subject_programmings');
    }

    public function coordinator() {
       return $this->belongsToMany('OSD\Coordinator','subject_programmings');
    }

    public function section() {
       return $this->belongsToMany('OSD\Section','subject_programmings');
    }


   /* semester_survey relation*/

     public function survey() {
       return $this->belongsToMany('OSD\Survey','semester_surveys')->withPivot('active','start_date','end_date');
    }


}
