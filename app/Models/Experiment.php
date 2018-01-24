<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Experiment extends Model
{
    protected $fillable = [
        'project_id', 'name', 'description', 'added_at', 'is_abtest', 'is_active'
    ];

    protected $table = 'experiments';
}
