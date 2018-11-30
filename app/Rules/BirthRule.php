<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class BirthRule implements Rule
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
        return gmdate($value) <= gmdate('Y-m-d', strtotime("-18 years"));
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return trans('validation.attributes.birth-minor');
    }
}
