<?php

namespace OSD;

use Illuminate\Database\Eloquent\Model;

class Semester_Survey extends Model
{
     protected $fillable = [
        'active', 'start_date', 'end_date',
    ];
}
