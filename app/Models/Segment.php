<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Segment
 * @package App\Models
 *
 * @property string $pages
 *
 * @property Page[] $pages
 */
class Segment extends Model
{
    protected $fillable = [
        'project_id', 'name'
    ];

    protected $table = 'segments';


    public function experiments()
    {
        return $this->belongsToMany('App\Models\Experiment', 'experiment_segments');
    }

    public function pages()
    {
        return $this->belongsToMany('App\Models\Page', 'segment_page');
    }

    /**
     * Get the comments for the blog post.
     */

    public function getPatterns() {
        $pages = [];

        foreach ($this->pages as $page) {
            $pages[] = $page->pages;
        }

        return $pages;
    }
}
