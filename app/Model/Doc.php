<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Doc extends Model
{
    protected $fillable = [
        'id',
        'project_id',
        'title',
        'doc_path',
        'updated_at',
    ];
}
