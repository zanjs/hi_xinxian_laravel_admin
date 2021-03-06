<?php

namespace App\Model\Card;

use Illuminate\Database\Eloquent\Model;

class UserCa extends Model
{

    protected $connection = 'mysql_card';
    //
    protected $table = 'user_cas';


    public function market()
    {
        return $this->hasOne('App\Model\Card\Market','id','market_id');
    }

    public function operator()
    {
        return $this->hasOne('App\Model\Card\Operator','id','operator_id');
    }
}
