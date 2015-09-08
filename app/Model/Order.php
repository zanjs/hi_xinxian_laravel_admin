<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';

    public function getProductJsonAttribute($value)
    {
        return json_decode($value);
    }

    public function setProductJsonAttribute($value)
    {
        $this->attributes['product_json'] = json_encode($value);
    }

}
