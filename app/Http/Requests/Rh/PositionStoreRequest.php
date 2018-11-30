<?php

namespace App\Http\Requests\Rh;

use App\Rules\BirthRule;
use App\Rules\SexRule;
use App\Rules\TelRule;
use Illuminate\Foundation\Http\FormRequest;

class PositionStoreRequest extends FormRequest
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
            'first_name' => 'required|string|min:3|max:20',
            'last_name' => 'required|string|min:3|max:20',
            'address' => 'nullable|string|min:10|max:100',
            'sex' => ['nullable', 'string', new SexRule()],
            'city_id' => 'required|int|exists:cities,id',
            'birth' => ['nullable','date', new BirthRule()],
            'cin' => 'nullable|unique:infos,cin',
            'face' => 'nullable|mimes:png,jpg,jpeg,bmp',
            'email' => 'unique:emails,email',
            'tel' => ['required','min:10','max:10', new TelRule(), 'unique:tels,tel'],
        ];
    }
}
