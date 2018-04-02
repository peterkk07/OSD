<?php

namespace OSD;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


     public function knowledge_areas() {

        return $this->belongsTo('OSD\KnowledgeArea');
    }

     public function type_user() {
        return $this->belongsTo('OSD\UserType');
    }
}


