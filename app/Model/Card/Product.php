<?php

namespace App\Model\Card;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $connection = 'mysql_card';
    protected $table = 'products';

    public function market()
    {
        return $this->hasOne('App\Model\Card\Market','id','market_id');
    }
}
