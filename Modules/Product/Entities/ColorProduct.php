<?php

namespace Modules\Product\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Admin\Entities\Prdocut;

class ColorProduct extends Model
{
    protected $fillable = [];

    public function color()
    {
        return $this->belongsTo(Color::class,'id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class,'id');
    }
}
