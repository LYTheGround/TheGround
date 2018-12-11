<?php

namespace App\Http\Requests\RH;

use App\Rules\BirthRule;
use App\Rules\IdentityRule;
use App\Rules\PasswordRule;
use App\Rules\SexRule;
use App\Rules\TelRule;
use Illuminate\Foundation\Http\FormRequest;

class InfoRequest extends FormRequest
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
            'face'          => 'nullable|mimes:jpeg,bmp,jpeg,png',
            'name'          => 'bail|required|string|max:25|unique:members,id,' . auth()->user()->member->id,
            'email'         => 'required|string|email|max:80|unique:emails,info_id,' . auth()->user()->member->info->id,
            'tel'           => ['bail','required','min:10','max:10',new TelRule(),'unique:tels,info_id,' . auth()->user()->member->info->id],
            'first_name'    => 'required|string|min:2|max:20',
            'last_name'     => 'required|string|min:2|max:20',
            'sex'           => ['nullable', new SexRule()],
            'birth'         => ['bail','nullable','date',new BirthRule()],
            'address'       => 'nullable|string|min:10|max:100',
            'city'          => 'bail|required|exists:cities,id',
            'cin'           => 'nullable|string|max:20',
            'identity'      => ['required', new IdentityRule()],
            'password'      => ['bail','nullable','required_with:password_confirmation','string','min:6','max:18','confirmed',new PasswordRule()],
        ];
    }
}
