<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use App\Rules\IsUnique;

class ProductRequest extends FormRequest
{

    protected $stopOnFirstFailure = true;
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    protected $rules_set = [
        'data.product_quantity'=>['required', 'numeric'],
        'data.product_price'=>['required', 'numeric']
    ];

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $this->rules_set += ['data.product_name'=>['required', 'string', new IsUnique('product_name')]];
        return $this->rules_set;
    }

    // protected function prepareForValidation(){
    //     $this->merge([
    //         'data.product_name' => trim($this->product_name),
    //     ]);
    // }

    public function messages(){
        return [
            "data.product_quantity.required" => "Product quantity is required",
            "data.product_price.required" => "Product price is required"
        ];
    }

    /**
     * If validator fails return the exception in json form
     * @param Validator $validator
     * @return array
     */
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json(['errors' => $validator->errors()], 422));
    }
}
