<?php

namespace OSD;

use Illuminate\Database\Eloquent\Model;

class SurveyEvaluation extends Model
{
    
    protected $fillable = [
        'date', 'description', 'student_id','student_programming_id','semester_survey_id'
    ];

   /* survey answer relation (pivot)*/
	public function question() {
       
       return $this->belongsToMany('OSD\SurveyQuestion','survey_answers')->withPivot('id','survey_option_id','survey_question_id','survey_evaluation_id');
    }


    public function option() {
       
       return $this->belongsToMany('OSD\SurveyOption','survey_answers')->withPivot('id','survey_option_id','survey_question_id','survey_evaluation_id');
    }


}
