<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Segment
 * @package App\Models
 *
 * @property string $pages
 *
 * @property integer $id
 * @property integer $project_id
 * @property string $name
 *
 */
class Segment extends Model
{
    protected $fillable = [
        'project_id', 'name'
    ];

    protected $table = 'segments';


    public function experiments()
    {
        return $this->belongsToMany(Experiment::class, 'experiment_segments');
    }

    public function pages()
    {
        return $this->belongsToMany(Page::class, 'segment_page');
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
