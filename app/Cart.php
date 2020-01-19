<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Modules\Product\Entities\Product;

class Cart extends Model
{
    protected $fillable = ['session_id','product_id','quantity','color','size'];

    public static $CART_KEY = "mycartkey#";
    public static $PRODUCT_ID_COLUMN = "product_id";
    public static $SESSION_ID_COLUMN = "session_id";
    public static $COLOR_COLUMN = "color";
    public static $SIZE_COLUMN = "size";
    public static $QTY_COLUMN = "quantity";

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

}
