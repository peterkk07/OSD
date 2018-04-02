<?php

namespace OSD;

use Illuminate\Database\Eloquent\Model;

class SubjectType extends Model
{
    protected $fillable = [
        'name', 
    ];

    public function subject() {
        return $this->hasMany('OSD\Subject', 'subject_id');
    }  
}
