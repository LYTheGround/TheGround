<?php

namespace App\Http\Requests\Admin;

use App\Rules\PasswordRule;
use Illuminate\Foundation\Http\FormRequest;

class AdminUpdateRequest extends FormRequest
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
            'email'     => 'required|email|unique:users,email,' . $this->admin->user->id,
            'login'     => 'required|string|unique:users,login,' . $this->admin->user->id,
            'password'  => ['bail','nullable','string','min:6','max:18','confirmed',new PasswordRule()],
        ];
    }
}
