<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Competition extends Model
{
    protected $guarded = [];

    protected $with = ['category'];


    public function getImgPathAttribute()
    {
        return asset('storage/main/competitions/'. $this->image);
    }

    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    public function posters()
    {
        return $this->hasMany('App\Posters');
    }

    public function results()
    {
        return $this->hasMany('App\result');
    }

}
