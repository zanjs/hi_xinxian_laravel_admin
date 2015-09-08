<?php

namespace App\Model\Card;

use Illuminate\Database\Eloquent\Model;

class Operator extends Model
{
    protected $connection = 'mysql_card';
    protected $table = 'operators';

    protected $hidden = ['password','remember_token'];

    public function market()
    {
        return $this->hasOne('App\Model\Card\Market','id','market_id');
    }
    /*public function market()
    {

        return $this->belongsTo('App\Model\Card\Market', 'market', 'id');
    }*/
}
