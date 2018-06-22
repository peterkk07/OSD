<?php

namespace OSD;

use Illuminate\Database\Eloquent\Model;

class Pregunta extends Model
{
    public function opcion() {

        return $this->belongsToMany('OSD\Opcion','respuestas');
    }

 
}
