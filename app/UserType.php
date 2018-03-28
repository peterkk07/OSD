<?php

namespace OSD;

use Illuminate\Database\Eloquent\Model;

class UserType extends Model
{
   protected $fillable = [
        'description', 
    ];

    public function subject() {
        return $this->hasMany('OSD\User', 'user_type_id');
    }  
}
