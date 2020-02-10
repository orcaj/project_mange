<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Lga extends Model
{
    protected $fillable = [
        'id',
        'lga_name',
        'short_name',
    ];
}
