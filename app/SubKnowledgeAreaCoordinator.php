<?php

namespace OSD;

use Illuminate\Database\Eloquent\Model;

class SubKnowledgeAreaCoordinator extends Model
{


	protected $fillable = [
        'name', 'email', 'password', 'ci', 'sub_knowledge_area_id',
    ];



    public function sub_knowledge_area() {

      return $this->belongsTo('OSD\SubKnowledgeArea', 'sub_knowledge_area_id');

    }
}



