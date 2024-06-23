<?php

namespace App\Http\Requests;

use App\Rules\IsUnique;

class UpdateProductRequest extends ProductRequest
{

    public function rules()
    {
        $this->rules_set += [
            'data.product_name'=>['required', 'string' ],
            'new_name' => ['nullable', 'string', new IsUnique('product_name')],
            'id'=> ['nullable', 'string']
        ];
        return $this->rules_set;
    }
}
