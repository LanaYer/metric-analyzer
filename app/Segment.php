<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Segment extends Model
{
    protected $fillable = [
        'project_id', 'name', 'pages'
    ];

    protected $table = 'segments';
}
