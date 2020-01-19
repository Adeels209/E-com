<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Product\Entities\Product;

class Wishlist extends Model
{
    use SoftDeletes;

    public static $_COLUMN_PRODUCT_ID   = 'product_id';
    public static $_COLUMN_USER_ID      = 'user_id';


    protected $fillable = ['product_id','user_id'];



    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
