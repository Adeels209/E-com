<?php

namespace Modules\Admin\Entities;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $fillable = [];

    public function products()
    {
        return $this->hasMany(Prdocut::class,'brand_id');
    }
}
