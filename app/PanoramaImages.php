<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Modules\Product\Entities\Product;

class PanoramaImages extends Model
{
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
