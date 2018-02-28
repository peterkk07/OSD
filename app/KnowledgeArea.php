<?php

namespace OSD;

use Illuminate\Database\Eloquent\Model;

class KnowledgeArea extends Model
{
     
     protected $fillable = [
        'name', 
    ];



 public function user() {

        return $this->hasMany('OSD\User');

    }

  public function subject() {

        return $this->hasMany('OSD\Subject');

    }  

     public function teacher() {

        return $this->hasMany('OSD\Teacher');

    }  

     public function student() {

        return $this->hasMany('OSD\Student');

    }  

}

