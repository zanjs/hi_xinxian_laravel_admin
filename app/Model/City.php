<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $table ='cities';

    public function parentCity()
    {

        return $this->belongsTo('App\Model\City', 'pid', 'id');
    }

    public function childrenCities()
    {

        return $this->hasMany('App\Model\City', 'pid', 'id');
    }
}
