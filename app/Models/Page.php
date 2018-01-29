<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Segment
 * @package App\Models
 *
 * @property string $pages
 */
class Page extends Model
{
    protected $fillable = [
        'project_id', 'name', 'pages'
    ];

    protected $table = 'pages';

}