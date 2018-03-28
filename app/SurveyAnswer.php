<?php

namespace OSD;

use Illuminate\Database\Eloquent\Model;

class Survey_Answer extends Model
{
      public function survey_question() {

       return $this->belongsTo('OSD\SurveyQuestion', 'survey_question_id');

    }

     public function survey_evaluation() {
      
       return $this->belongsTo('OSD\SurveyEvaluation', 'survey_evaluation_id');
    }

     public function survey_option() {
      
       return $this->belongsTo('OSD\SurveyOption', 'survey_option_id');
    }

}
