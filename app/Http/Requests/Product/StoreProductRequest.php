<?php

namespace App\Http\Requests\Product;

use Illuminate\Support\Str;
use Illuminate\Foundation\Http\FormRequest;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class StoreProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
//            'product_image'     => 'image|file|max:2048',
//            'name'              => 'required|string',
//            'category_id'       => 'required|integer',
//            'unit_id'           => 'required|integer',
//            'quantity'          => 'required|integer',
//            'buying_price'      => 'required|integer',
//            'selling_price'     => 'required|integer',
//            'quantity_alert'    => 'required|integer',
//            'tax'               => 'nullable|numeric',
//            'tax_type'          => 'nullable|integer',
//            'notes'             => 'nullable|max:1000'
            'companyName' => 'required|string',
            'challanNo' => 'required|alpha_dash:ascii',
            'unit' => 'required',
            'apmChallanNo' => 'required|alpha_dash:ascii',
            'size' => 'required|numeric',
            'quantity' => 'required|integer',
            'for' => 'required|string',
            'cuttingSize' => 'required|numeric',
            'cuttingWeight' => 'required|numeric',
            'orderNo' => 'required|integer',
            'orderSize' => 'required|numeric',
            'notes' => 'string'
        ];
    }

    // protected function prepareForValidation(): void
    // {
    //     $this->merge([
    //         'slug' => Str::slug($this->name, '-'),
    //         'code' =>
    //     ]);
    // }
}
