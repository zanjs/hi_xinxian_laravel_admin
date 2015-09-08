<?php

namespace App\Model\Card;

use Illuminate\Database\Eloquent\Model;

class Recharge extends Model
{
    protected $connection = 'mysql_card';
    protected $table = 'recharges';

    public function operator()
    {
        return $this->hasOne('App\Model\Card\Operator','id','operator_id');
    }

    public function market()
    {
        return $this->hasOne('App\Model\Card\Market','id','market_id');
    }
}
