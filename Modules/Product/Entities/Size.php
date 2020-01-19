<?php

namespace Modules\Product\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * @method static findOrFail($size_id)
 */
class Size extends Model
{
    protected $fillable = ['size'];

    public function products()
    {
        return $this->belongsToMany(Product::class,'product_sizes','size_id','product_id');
    }
}
