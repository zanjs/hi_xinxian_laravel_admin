<?php

namespace App\Model\Card;

use Illuminate\Database\Eloquent\Model;

class UpdateCard extends Model
{
    protected $connection = 'mysql_card';
    protected $table = 'update_cards';

    public function market()
    {
        return $this->hasOne('App\Model\Card\Market','id','market_id');
    }

    public function operator()
    {
        return $this->hasOne('App\Model\Card\Operator','id','operator_id');
    }
}
