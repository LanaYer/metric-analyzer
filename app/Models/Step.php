<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Eloquent\Builder ;

/**
 * Class Project

 * @property integer $id
 * @property integer $experiment_id
 * @property string $description
 * @property string $start_at
 *
 * @property string $ym_login
 * @property string $ym_token
 *
 */
class Step extends Model
{

    protected $fillable = [
        'experiment_id', 'description', 'start_at'
    ];

    protected $table = 'experiment_steps';


    public function experiment()
    {
        return $this->belongsTo(Experiment::class);
    }

}
