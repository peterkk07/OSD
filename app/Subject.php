<?php

namespace OSD;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
     protected $fillable = [
        'cod', 'password', 'name', 'semester', 
    ];


     public function subject_program() {

        return $this->hasMany('OSD\SubjectProgramming', 'subject_id');

    }

    public function knowledge_area() {

       return $this->belongsTo('OSD\KnowledgeArea', 'knowledge_area_id');

    }

    public function type_subject() {

       return $this->belongsTo('OSD\SubjectType', 'subject_type_id');

    }

     
}
