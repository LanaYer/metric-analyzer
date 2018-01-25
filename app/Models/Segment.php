<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Segment
 * @package App\Models
 *
 * @property string $pages
 */
class Segment extends Model
{
    protected $fillable = [
        'project_id', 'name', 'pages'
    ];

    protected $table = 'segments';


    public function getPatterns() {
        return $this->pages;
    }
}
