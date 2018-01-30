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

    /**
     * Get the comments for the blog post.
     */
    public function pages()
    {
        return $this->belongsToMany(Page::class, "segment_page", "segment_id", "project_page_id");
    }


    public function getPatterns() {
        $pages = [];

        foreach ($this->pages as $page) {
            $pages[] = $page->pages;
        }

        return $pages;
    }
}
