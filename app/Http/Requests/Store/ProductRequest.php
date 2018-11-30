<?php

namespace App\Http\Requests\Store;

use App\Rules\TvaRule;
use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'name'          => 'required|string|min:3|max:50',
            'tva'           => ['required', new TvaRule()],
            'size'          => 'nullable|string|min:3|max:15',
            'description'   => 'nullable|string|min:10|max:100',
            'img.*'         => 'nullable|mimes:jpg,jpeg,png,bmp'
        ];
    }
}
