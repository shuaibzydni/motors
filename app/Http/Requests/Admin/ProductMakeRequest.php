<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ProductMakeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $validation = [
            'product_brand_id' => 'required|exists:product_brands,id',
            'name' => 'required|string|max:100|unique:product_makes,name,NULL,id,product_brand_id,'.$this->product_brand_id,
        ];

        if ($this->method() === "PUT") {
            $validation = [
                'product_brand_id' => 'required|exists:product_brands,id',
                'name' => 'required|string|max:100|unique:product_makes,name,' . $this->route('productMake')->id . ',id,product_brand_id,'.$this->product_brand_id,
            ];
        }

        return $validation;
    }
}
