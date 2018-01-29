<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SegmentPage extends Model
{
    protected $fillable = [
        'segment_id', 'project_page_id'
    ];

    protected $table = 'segment_page';
}
