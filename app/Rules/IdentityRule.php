<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class IdentityRule implements Rule
{

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return ($value == 'email' || $value == 'name' || $value == 'tel');
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return trans('validation.regex',['sex']);
    }
}
