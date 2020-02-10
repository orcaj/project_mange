<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Picreport extends Model
{
    protected $fillable = [
        'id',
        'project_id',
        'title',
        'pic_path',
        'updated_at',
    ];
}
