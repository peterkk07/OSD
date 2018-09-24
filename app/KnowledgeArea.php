<?php

namespace OSD;

use Illuminate\Database\Eloquent\Model;

class KnowledgeArea extends Model
{
     
    protected $fillable = [
        'name', 'score',
    ];


    public function user() {

        return $this->hasMany('OSD\User', 'knowledge_area_id');
    }

    public function subject() {

         return $this->hasMany('OSD\Subject', 'knowledge_area_id');
    }  

     public function teacher() {

        return $this->hasMany('OSD\Teacher', 'knowledge_area_id');
    }  

    public function student() {

        return $this->hasMany('OSD\Student', 'knowledge_area_id');
    }  

    public function coordinator() {

        return $this->hasMany('OSD\Coordinator', 'knowledge_area_id');
    }  

    public function subKnowledgeArea() {

        return $this->hasMany('OSD\SubKnowledgeArea', 'knowledge_area_id');
    }  



}

