<?php

namespace App\Model\Card;

use Illuminate\Database\Eloquent\Model;

class CountOrder extends Model
{
    protected $connection = 'mysql_card';
    protected $table = 'count_orders';

    public function market()
    {
        return $this->hasOne('App\Model\Card\Market','id','market_id');
    }

    public function operator()
    {
        return $this->hasOne('App\Model\Card\Operator','id','operator_id');
    }
}
