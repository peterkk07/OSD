<?php

namespace OSD;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    

    protected $fillable = [
        'name', 'email', 'password', 'ci',
    ];

      /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    

}
