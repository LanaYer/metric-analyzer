<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{

    protected $fillable = [
        'user_id', 'name', 'url', 'ym_login', 'ym_token'
    ];

    protected $table = 'projects';
}
