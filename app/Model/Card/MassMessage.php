<?php

namespace App\Model\Card;

use Illuminate\Database\Eloquent\Model;

class MassMessage extends Model
{
    protected $connection = 'mysql_card';
    protected $table = 'mass_messages';

    public function user()
    {
        return $this->hasOne('App\User','id','user_id');
    }
}
