<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Utils\InventoryConnector;

class IsUnique implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($param=null)
    {
        $this->attribute = $param;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value){
        $key = $this->attribute ? $this->attribute : $attribute;
        return !InventoryConnector::getInstance()->getData()->contains($key, $value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Each product must be unique. Please provide another product name or update the product instead.';
    }
}
