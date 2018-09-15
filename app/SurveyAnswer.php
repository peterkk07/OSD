<?php

namespace OSD;

use Illuminate\Database\Eloquent\Model;

class SurveyAnswer extends Model
{

	 protected $fillable = [
        'survey_option_id', 'survey_question_id', 'survey_evaluation_id',
    ];

}
