<?php

namespace Modules\Product\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * @method static findOrFail($color_id)
 */
class Color extends Model
{
    protected $fillable = ['color'];


    public function products()
    {
        return $this->belongsToMany(Product::class,'ColorProduct','product_id','color_id');
    }
}
