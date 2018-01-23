<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Eloquent\Builder ;

/**
 * Class Project
 *
 * @property string $ym_login
 * @property string $ym_token
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
     * @return mixed
     */
    public function scopeActive(Builder $query, $case = null, bool $multiple = false)
    {
        return $query->where('is_active', '=', '1');
    }

}
