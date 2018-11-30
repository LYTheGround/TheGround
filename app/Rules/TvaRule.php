<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class TvaRule implements Rule
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
        return ($value == '0' || $value == '7' || $value == '14' || $value == '20');
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return trans('validation.regex',['TVA']);
    }
}
