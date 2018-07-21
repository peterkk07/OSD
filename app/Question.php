<?php

namespace OSD;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = [
        'description', 
    ];


    public function survey() {

        return $this->belongsToMany('OSD\Survey','survey_questions')->withPivot('description');
    
    }

}
