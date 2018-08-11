<?php

namespace OSD;

use Illuminate\Database\Eloquent\Model;

class SubKnowledgeArea extends Model
{
     protected $fillable = [
        'name', 
    ];


    public function user() {

        return $this->hasMany('OSD\User', 'knowledge_area_id');
    }

    public function subject() {

         return $this->hasMany('OSD\Subject', 'sub_knowledge_area_id');
    }  

     public function teacher() {

        return $this->hasMany('OSD\Teacher', 'knowledge_area_id');
    }  

    public function student() {

        return $this->hasMany('OSD\Student', 'knowledge_area_id');
    }  

    public function sub_knowledge_area_coordinator() {

        return $this->hasMany('OSD\SubKnowledgeAreaCoordinator', 'sub_knowledge_area_id');
    }  

    public function knowledgeArea() {

        return $this->belongsTo('OSD\KnowledgeArea', 'knowledge_area_id');
    }
}
