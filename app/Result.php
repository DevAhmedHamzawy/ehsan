<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    protected $guarded = [];

    protected $with = ['user', 'competition'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function competition()
    {
        return $this->belongsTo('App\Competition');
    }
}
