<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Zone extends Model
{
    protected $fillable = [
        'id',
        'zone_name',
        'short_name',
    ];
}
