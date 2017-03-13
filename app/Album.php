<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'recorded_date',
        'release_date'
    ];

    public function band(){
        return $this->belongsTo('App\Band');
    }
}
