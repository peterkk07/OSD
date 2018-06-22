<?php

namespace OSD;

use Illuminate\Database\Eloquent\Model;

class SemesterSurvey extends Model
{
     protected $fillable = [
        'status', 'start_date', 'end_date',
    ];

 
    public function survey() {

       return $this->belongsTo('OSD\Survey','survey_id');
    }

}
