<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Mda extends Model
{
    protected $fillable = [
        'id',
        'name',
        'short_name',
    ];

    public function projects(){
        return $this->hasMany('App\Model\Project');
    }
}
