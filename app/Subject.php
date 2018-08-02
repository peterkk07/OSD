<?php

namespace OSD;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
     protected $fillable = [
        'cod', 'password', 'name', 'semester', 
    ];


    public function knowledge_area() {

       return $this->belongsTo('OSD\KnowledgeArea', 'knowledge_area_id');
    }

    public function sub_knowledge_area() {

       return $this->belongsTo('OSD\SubKnowledgeArea', 'sub_knowledge_area_id');
    }

    public function type_subject() {
      
       return $this->belongsTo('OSD\SubjectType', 'subject_type_id');
    }


/*subject programming relation*/
    public function teacher() {
         
        return $this->belongsToMany('OSD\Teacher','subject_programmings');
    }

    public function semester() {
         
        return $this->belongsToMany('OSD\Semester','subject_programmings');
    }

    public function section() {
         
        return $this->belongsToMany('OSD\Section','subject_programmings');
    }

    public function coordinator() {
         
        return $this->belongsToMany('OSD\Coordinator','subject_programmings');
    }


     
}
