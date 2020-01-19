<?php

namespace Modules\Product\Entities;

use Illuminate\Database\Eloquent\Model;

class ProductSize extends Model
{
    protected $fillable = [];

    public function products()
    {
        return $this->belongsTo(Product::class);
    }

    public function size()
    {
        return $this->belongsTo(Size::class);
    }
}
