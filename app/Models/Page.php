<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Segment
 * @package App\Models

 * @property integer $id
 * @property integer $project_id
 * @property string $name
 *
 * @property string $pages
 */
class Page extends Model
{
    protected $fillable = [
        'project_id', 'name', 'pages'
    ];

    protected $table = 'pages';

    public function segments()
    {
        return $this->belongsToMany(Segment::class, 'segment_page');
    }

}
