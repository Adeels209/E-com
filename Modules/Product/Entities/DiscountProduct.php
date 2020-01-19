<?php

namespace Modules\Product\Entities;

use Illuminate\Database\Eloquent\Model;

class DiscountProduct extends Model
{
    protected $fillable = [];

    public function product()
    {
        return $this->belongsTo(Product::class,'product_id');
    }
    public function discount()
    {
        return $this->belongsTo(Discount::class,'discount_id');
    }
}
