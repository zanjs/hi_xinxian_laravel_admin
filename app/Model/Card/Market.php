<?php

namespace App\Model\Card;

use Illuminate\Database\Eloquent\Model;

class Market extends Model
{
    protected $connection = 'mysql_card';
    protected $table = 'markets';
}
