<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Poster extends Model
{
    protected $guarded = [];

    public function getImgPathAttribute()
    {
        return asset('storage/main/posters/'. $this->image);
    }

}
