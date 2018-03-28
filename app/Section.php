<?php

namespace OSD;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    
 	protected $fillable = [
        'description', 
    ];


    public function subject_programing() {

        return $this->hasMany('OSD\SubjectProgramming', 'section_id');
    }
    
}
