<?php

namespace OSD;

use Illuminate\Database\Eloquent\Model;

class Survey_Answer extends Model
{
      public function questionsurvey() {

       return $this->belongsTo('OSD\Survey_Question');

    }


     public function evaluationsurvey() {

       return $this->belongsTo('OSD\Survey_Evaluation');

    }



}
