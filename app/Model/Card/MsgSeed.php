<?php

namespace App\Model\Card;

use Illuminate\Database\Eloquent\Model;

class MsgSeed extends Model
{
    protected $connection = 'mysql_card';
    /*发送短信记录表*/
    protected $table = 'msg_seeds';
}
