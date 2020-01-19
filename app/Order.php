<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class,'order_id');
    }

    public function setOrderNoAttribute($value)
    {
        $order =  Order::all()->last();
        $order_no = 0;
        if ($order) {
            $order_no = $order->order_no + 1;
        } else {
            $order_no++;
        }
        $this->attributes['order_no'] = $order_no;
    }

}
