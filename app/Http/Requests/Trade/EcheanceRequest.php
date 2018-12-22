<?php

namespace App\Http\Requests\Trade;

use Illuminate\Foundation\Http\FormRequest;

class EcheanceRequest extends FormRequest
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
            'date'  => 'required|date|after_or_equal:today'
        ];
    }

    public function messages()
    {
        return [
            'after_or_equal' => 'Le champ date doit être une date postérieure ou égale  à ' . ucfirst(__('validation.attributes.today')) . '.'
        ];
    }
}
