<?php

namespace App\Model\Card;

use Illuminate\Database\Eloquent\Model;

class OpenLog extends Model
{
    protected $connection = 'mysql_card';
    protected $table = 'open_logs';

    public function operator()
    {
        return $this->hasOne('App\Model\Card\Operator','id','operator_id');
    }

    public function market()
    {
        return $this->hasOne('App\Model\Card\Market','id','market_id');
    }
}
