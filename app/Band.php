<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Band extends Model
{
    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'start_date'
    ];

    public function albums(){
        return $this->hasMany('App\Album')->orderBy('release_date');
    }
}
