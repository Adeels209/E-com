<?php

namespace Modules\Product\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'subcategory_id'=>'required',
            'brand_id'=>'required',
            'color_id'=>'required',
            'size_id'=>'required',
            'product_name'=>'required',
            'shortdescription'=>'required',
            'longdescription'=>'required',
            'sprice'=>'required',
            'cprice'=>'required',




        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}
