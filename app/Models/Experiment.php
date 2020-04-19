<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Experiment
 * @package App\Models
 *
 * @property integer $project_id
 * @property integer $id
 * @property string $name;
 * @property string $description
 * @property string $added_at
 * @property integer $is_abtest
 * @property integer $is_active
 *
 * @property Segment[] $segments
 * @property Project $project
 */
class Experiment extends Model
{
    protected $fillable = [
        'project_id', 'name', 'description', 'added_at', 'is_abtest', 'is_active'
    ];

    protected $table = 'experiments';

    /**
     * Get the post that owns the comment.
     */
    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    /**
     * Get the comments for the blog post.
     */
    public function segments()
    {
        return $this->belongsToMany(Segment::class, 'experiment_segments');
    }

    public function steps()
    {
        return $this->hasMany(Step::class);
    }

    public function pages()
    {
        return $this->belongsToMany(Page::class, 'experiment_pages');
    }
    /**
     * Активные проекты
     *
     * @param Builder $query
     * @param null    $case
     * @param bool    $multiple
     * @return mixed
     */
    public function scopeActive(Builder $query, $case = null, bool $multiple = false)
    {
        return $query->where('is_active', '=', '1');
    }

    /**
     * Возвращает список графиков для этого эксперимента
     *
     * @return mixed
     */
    public function getGraphs()
    {
        $graphs = config('analyzer.graphs');
        foreach ($graphs as $name => $params) {
            $graphs[$name]['data'] = $this->project->getDataDir() . "/" . $this->id . "_" . $name . ".csv";
        }

        return $graphs;
    }

    /**
     * @return true
     */
    public function saveJsonDescription()
    {
        $json = ['patterns' => []];
        foreach ($this->segments as $segment) {
            $json['patterns'][] = ['title' => $segment->name, 'patterns' => $segment->getPatterns()];
        }

        return \file_put_contents(
            $this->project->getDataDir()."/".$this->id.".json",
            json_encode($json)
        );
    }


}
