<?php

namespace OSD;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
     protected $fillable = [
        'cod', 'password', 'name', 'semester', 
    ];


     public function subject_program() {

        return $this->hasMany('OSD\Subject_Programming');

    }

    public function knowlegde_area() {

       return $this->belongsTo('OSD\Knowlegde_area');

    }

     
}
