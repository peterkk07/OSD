<?php

namespace OSD;

use Illuminate\Database\Eloquent\Model;

class Coordinator extends Model
{
    protected $fillable = [
        'name', 'email', 'password', 'ci', 'knowledge_area_id',
    ];

      /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    public function knowledge_area() {

      return $this->belongsTo('OSD\KnowledgeArea', 'knowledge_area_id');

    }

}
