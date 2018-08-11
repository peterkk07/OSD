<?php

namespace OSD;

use Illuminate\Database\Eloquent\Model;

class SubjectProgramming extends Model
{
    
	public function student() {
		
       return $this->belongsToMany('OSD\Student','student_programmings')->withPivot('id');
    }
    
}
