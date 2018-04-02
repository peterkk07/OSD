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


    public function subject() {
       return $this->belongsToMany('OSD\Subject','subject_programmings');
    
    }

    public function coordinator() {
       return $this->belongsToMany('OSD\Coordinator','subject_programmings');
    
    }

    public function section() {
       return $this->belongsToMany('OSD\Section','subject_programmings');
    
    }

    public function semester() {
       return $this->belongsToMany('OSD\Semester','subject_programmings');
    
    }

     public function knowlegde_area() {

       return $this->belongsTo('OSD\KnowlegdeArea', 'knowlegde_area_id');

    }

}
