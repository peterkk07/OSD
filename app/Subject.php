<?php

namespace OSD;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
     protected $fillable = [
        'cod', 'password', 'name', 'semester', 
    ];


     public function subject_program() {

        return $this->hasMany('OSD\SubjectProgramming');

    }

    public function knowlegde_area() {

       return $this->belongsTo('OSD\KnowlegdeArea');

    }

     
}
