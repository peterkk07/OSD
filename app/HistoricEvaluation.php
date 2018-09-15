<?php

namespace OSD;

use Illuminate\Database\Eloquent\Model;

class HistoricEvaluation extends Model
{
    protected $fillable = [
        'evaluation','semester' 
    ];
}
