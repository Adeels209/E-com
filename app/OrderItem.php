<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Modules\Product\Entities\Product;

class OrderItem extends Model
{
    public function order()
    {
        return $this->belongsTo(Order::class, "order_id");
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
