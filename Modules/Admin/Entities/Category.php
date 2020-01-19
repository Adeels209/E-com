<?php

namespace Modules\Admin\Entities;

use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Illuminate\Database\Eloquent\Model;
use Modules\Product\Entities\Product;

class Category extends Model
{
    protected $fillable = ['name', 'description', 'image'];
    use Sluggable;
    use SluggableScopeHelpers;

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }
    public function childCategory()
    {
        return $this->hasMany(Category::class,'parent_id','id');
    }

    public function childCategoryEager()
    {
        return $this->hasMany(Category::class,'parent_id','id')->limit(3);
    }

    public function parentCategory()
    {
        return $this->belongsTo(Category::class,'parent_id','id');
    }

    public function products()
    {
        return $this->hasMany(Product::class,'category_id','id');
    }

    public function productss()
    {
        return $this->hasMany(Product::class, 'subcategory_id', 'id');
    }

}
