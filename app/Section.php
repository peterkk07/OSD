<?php

namespace OSD;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    
 	protected $fillable = [
        'name', 
    ];


  
    public function subject() {
       return $this->belongsToMany('OSD\Subject','subject_programmings');
    
    }

    public function teacher() {
       return $this->belongsToMany('OSD\Teacher','subject_programmings');
    
    }

    public function coordinator() {
       return $this->belongsToMany('OSD\Coordinator','subject_programmings');
    
    }

    public function semester() {
       return $this->belongsToMany('OSD\Semester','subject_programmings');
    
    }
    
    
}
