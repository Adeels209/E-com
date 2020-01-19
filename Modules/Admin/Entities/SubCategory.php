<?php

namespace Modules\Admin\Entities;

use Illuminate\Database\Eloquent\Model;


class SubCategory extends Model
{
    protected $fillable = [];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
