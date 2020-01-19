<?php

namespace Modules\Product\Entities;

use Illuminate\Database\Eloquent\Model;

class ProductImages extends Model
{
    protected $fillable = [];

    public function product()
    {
        return $this->belongsTo(Product::class,'id');
    }
}
