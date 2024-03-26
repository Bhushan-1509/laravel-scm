<?php

namespace App\Http\Requests\Customer;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateCustomerRequest extends FormRequest
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
//        return [
//            'photo' => [
//                'image',
//                'file',
//                'max:1024'
//            ],
//            'name' => [
//                'required',
//                'string',
//                'max:50'
//            ],
//            'email' => [
//                'required',
//                'email',
//                'max:50'
//            ],
//            'phone' => [
//                'required',
//                'string',
//                'max:25'
//            ],
//            'account_holder' => [
//                'max:50'
//            ],
//            'account_number' => [
//                'max:25'
//            ],
//            'bank_name' => [
//                'max:25'
//            ],
//            'address' => [
//                'required',
//                'string',
//                'max:100'
//            ],
//        ];
        return [
            'companyName' => 'required|string',
            'address' => 'required|string',
            'city' => 'required|string',
            'pincode' => 'required',
            'state' => 'required|string',
            'gst_no' => 'required|string|max:15',
            'companyInSez'=> 'required',
            'companyType' => 'required',
            'andheri' => 'required|string',
            'vasai' => 'required|string'
        ];
    }
}
