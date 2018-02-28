<?php

namespace OSD;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'name', 'surname', 'email', 'ci', 
    ];
}
