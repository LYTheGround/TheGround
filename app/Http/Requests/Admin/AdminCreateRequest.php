<?php

namespace App\Http\Requests\Admin;

use App\Rules\PasswordRule;
use Illuminate\Foundation\Http\FormRequest;

class AdminCreateRequest extends FormRequest
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
        return [
            'email'     => 'required|email|unique:users,email',
            'login'     => 'required|string|unique:users,login',
            'password'  => ['bail','required','string','min:6','max:18','confirmed',new PasswordRule()],
        ];
    }
}
