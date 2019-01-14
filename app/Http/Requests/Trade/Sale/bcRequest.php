<?php

namespace App\Http\Requests\Trade\sale;

use Illuminate\Foundation\Http\FormRequest;

class bcRequest extends FormRequest
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
            'qt'            => 'required|int|',
            'purchased_id'  => 'required|int|exists:purchaseds,id'
        ];
    }
}
