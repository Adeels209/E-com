<?php

namespace Modules\Product\Entities;

use App\PanoramaImages;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Elasticquent\ElasticquentTrait;
use Illuminate\Database\Eloquent\Model;
use Modules\Admin\Entities\Brand;
use Modules\Admin\Entities\Category;

/**
 * @method static findOrFail($product_id)
 */
class Product extends Model
{


    protected $fillable = ['slug','brand_id','category_id','name','cost_price','selling_price','status','long_description','short_description'];

    use Sluggable;
    use SluggableScopeHelpers;
    use ElasticquentTrait;

    protected $mappingProperties = array(
        'name'=>[
            'type'=>'string',
            'analyzer'=>'standard'
        ]
    );

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    protected $indexSettings = [
        'analysis' => [
            'char_filter' => [
                'replace' => [
                    'type' => 'mapping',
                    'mappings' => [
                        '&=> and '
                    ],
                ],
            ],
            'filter' => [
                'word_delimiter' => [
                    'type' => 'word_delimiter',
                    'split_on_numerics' => false,
                    'split_on_case_change' => true,
                    'generate_word_parts' => true,
                    'generate_number_parts' => true,
                    'catenate_all' => true,
                    'preserve_original' => true,
                    'catenate_numbers' => true,
                ]
            ],
            'analyzer' => [
                'default' => [
                    'type' => 'custom',
                    'char_filter' => [
                        'html_strip',
                        'replace',
                    ],
                    'tokenizer' => 'whitespace',
                    'filter' => [
                        'lowercase',
                        'word_delimiter',
                    ],
                ],
            ],
        ],
    ];



    public function images()
    {
        return $this->hasMany(ProductImages::class, 'product_id');
    }

    public function colors()
    {
        return $this->belongsToMany(Color::class,'color_products','product_id','color_id');
    }

    public function sizes()
    {
        return $this->belongsToMany(Size::class,'product_sizes','product_id','size_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function stock()
    {
        return $this->hasOne(Stock::class);
    }

    public function discount()
    {
        return $this->hasOne(DiscountProduct::class, 'product_id');
    }

    public function panoramaImages()
    {
        return $this->hasMany(PanoramaImages::class, 'product_id');
    }



}
