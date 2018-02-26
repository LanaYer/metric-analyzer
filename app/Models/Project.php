<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Eloquent\Builder ;

/**
 * Class Project
 *
 * @property string $ym_login
 * @property string $ym_token
 * @property integer $id
 * @property integer $user_id
 * @property string $name
 * @property string $url
 * @property string $added_at
 * @property integer $is_active
 *
 * @property Page[] $pages
 * @property Segment[] $segments
 *
 */
class Project extends Model
{

    protected $fillable = [
        'user_id', 'name', 'url', 'ym_login', 'ym_token', 'start_at', 'last_load_at'
    ];

    protected $table = 'projects';

    /**
     * Активные проекты
     *
     * @param Builder $query
     * @param null    $case
     * @param bool    $multiple
     *
     * @return Builder
     */
    public function scopeActive(Builder $query, $case = null, bool $multiple = false)
    {
        return $query->where('is_active', '=', '1');
    }

    /**
     * Путь к папке с данными
     *
     * @return string
     */
    public function getDataDir()
    {
        return config('analyzer.path_to_data') . "/" . $this->id;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function experiments()
    {
        return $this->hasMany(Experiment::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function segments()
    {
        return $this->hasMany(Segment::class);
    }

    /**
     * Страницы у проекта
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pages()
    {
        return $this->hasMany(Page::class);
    }
}
