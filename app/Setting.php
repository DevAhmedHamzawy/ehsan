<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $guarded = [];


    public function getIconHeaderAdminPathAttribute()
    {
        return asset('storage/main/settings/ehsan.png');
    }


    public function getIconQrPathAttribute()
    {
        return asset('storage/main/settings/'.$this->qr_code);
    }


}
