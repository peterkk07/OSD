<?php

namespace OSD;

use Illuminate\Database\Eloquent\Model;

class Opcion extends Model
{
    public function pregunta() {

        return $this->belongsToMany('OSD\Pregunta','respuestas');
    }



}
