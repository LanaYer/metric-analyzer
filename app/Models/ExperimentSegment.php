<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExperimentSegment extends Model
{
    protected $fillable = [
        'experiment_id', 'segment_id'
    ];

    protected $table = 'experiment_segments';
}
