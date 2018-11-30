<?php

namespace App\Http\Requests\RH;

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
            'sex'           => ['required',auth()->user()->sex == 'homme'||auth()->user()->sex == 'femme'],
            'birth'         => 'bail|nullable|date|before:' . date('d-m-Y',strtotime("-18 years")),
            'address'       => 'nullable|string|min:10|max:100',
            'city'          => 'bail|required|int|exists:cities,id',
            'identity'  => ['required',auth()->user()->connect_with == 'email' || auth()->user()->connect_with == 'name' || auth()->user()->connect_with == 'tel'],
        ];
    }
}
