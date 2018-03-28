<?php

namespace OSD;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    

    protected $fillable = [
        'name', 'email', 'password', 'ci',
    ];

      /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    public function subject_programming() {

       return $this->hasMany('OSD\SubjectProgramming', 'teacher_id');

    }

     public function knowlegde_area() {

       return $this->belongsTo('OSD\KnowlegdeArea', 'knowledge_area_id');

    }

}
