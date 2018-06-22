<?php

namespace OSD;

use Illuminate\Database\Eloquent\Model;

class Dates extends Model
{
     protected $fillable = [
        'start_date', 'end_date', 
    ];

}
