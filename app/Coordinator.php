<?php

namespace OSD;

use Illuminate\Database\Eloquent\Model;

class Coordinator extends Model
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


    public function knowlegde_area() {

      return $this->belongsTo('OSD\KnowlegdeArea', 'knowlegde_area_id');

    }

}
