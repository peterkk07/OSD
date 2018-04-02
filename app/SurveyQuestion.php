<?php

namespace OSD;

use Illuminate\Database\Eloquent\Model;

class Survey_Question extends Model
{
    
    protected $fillable = [
        'description',
    ];

   /* opciones posibles*/
    public function options() {

       return $this->hasMany('OSD\SurveyOptions', 'survey_question_id');

    }

    /*survey answer relation (pivot)*/

     public function survey_options() {
       
       return $this->belongsToMany('OSD\SurveyOption','survey_answers');
    }

    public function survey_evaluation() {
       
       return $this->belongsToMany('OSD\SurveyEvaluation','survey_answers');
    }



}
