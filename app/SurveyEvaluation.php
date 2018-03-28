<?php

namespace OSD;

use Illuminate\Database\Eloquent\Model;

class Survey_Evaluation extends Model
{
    
    protected $fillable = [
        'date', 'description', 
    ];

	 public function survey_answer() {

        return $this->hasMany('OSD\SurveyAnswer', 'survey_evaluation_id');

    }


    public function student() {

       return $this->belongsTo('OSD\Student', 'student_id');
    }


}
