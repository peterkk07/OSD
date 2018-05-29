<?php

namespace OSD;

use Illuminate\Database\Eloquent\Model;

class SurveyEvaluation extends Model
{
    
    protected $fillable = [
        'date', 'description', 
    ];

   /* survey answrrt relation (pivot)*/
	public function question() {
       
       return $this->belongsToMany('OSD\SurveyQuestion','survey_answers');
    }


    public function option() {
       
       return $this->belongsToMany('OSD\SurveyOption','survey_answers');
    }


}
