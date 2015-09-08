<?php

namespace App\Model\Card;

use Illuminate\Database\Eloquent\Model;

class SmsRecord extends Model
{
    protected $connection = 'mysql_card';
    protected $table = 'sms_records';

    public function user()
    {
        return $this->hasOne('App\User','id','user_id');
    }
}
