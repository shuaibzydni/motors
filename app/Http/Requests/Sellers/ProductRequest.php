<?php

namespace App\Http\Requests\Sellers;

use App\Models\Product;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProductRequest extends FormRequest
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
            "product_brand_id" => "required|exists:product_brands,id",
            "product_make_id" => "required|exists:product_makes,id",
            "body_type_id" => "required|exists:body_types,id",
            "drive_type_id" => "required|exists:drive_types,id",
            "fuel_type_id" => "required|exists:fuel_types,id",
            "transmission_id" => "required|exists:transmissions,id",
            "model_year" =>
                "required|digits:4|integer|min:1900|max:" . (date("Y") + 1),
            // "name" => "string",
            "model_description" => "required|string",
            "odometer_mileage" => "required|string",
            "vehicle_registration_number" => "required|string",
            "vehicle_vin" => "required|string",
            "vehicle_price" => 'required|regex:/^\d+(\.\d{1,2})?$/',
            "service_log_book" =>
                "nullable|mimetypes:application/pdf|max:5120",
            "front_image" =>
                "required|image|mimes:jpeg,png,jpg,gif,svg|max:5120",
            "rear_image" =>
                "nullable|image|mimes:jpeg,png,jpg,gif,svg|max:5120",
            "left_side_image" =>
                "nullable|image|mimes:jpeg,png,jpg,gif,svg|max:5120",
            "interior_image" =>
                "nullable|image|mimes:jpeg,png,jpg,gif,svg|max:5120",
            "cargo_area_image" =>
                "nullable|image|mimes:jpeg,png,jpg,gif,svg|max:5120",
            "engine_bay_image" =>
                "nullable|image|mimes:jpeg,png,jpg,gif,svg|max:5120",
            "roof_image" =>
                "nullable|image|mimes:jpeg,png,jpg,gif,svg|max:5120",
            "wheels_image" =>
                "nullable|image|mimes:jpeg,png,jpg,gif,svg|max:5120",
            "keys_image" =>
                "nullable|image|mimes:jpeg,png,jpg,gif,svg|max:5120",
            "owners_manual" =>
                "nullable|mimetypes:application/pdf|max:5120",
            "vehicle_status" => ["nullable", Rule::in(Product::VEHICLE_STATUS)],
        ];

        if ($this->isMethod("put")) {
            $validation["front_image"] =
                "nullable|image|mimes:jpeg,png,jpg,gif,svg|max:5120";
        }

        return $validation;
    }

    public function messages()
    {
        return [
            "service_log_book.mimetypes" =>
                "The document must be of type pdf",
            "owners_manual.mimetypes" =>
                "The document must be of type pdf",
        ];
    }
}
