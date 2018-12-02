<?php

namespace App\Http\Requests\Trade\Sale;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class DvRequest extends FormRequest
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
            'client' => ['required', 'int', Rule::exists('clients', 'id')->where(function ($query) {
                $query->where('company_id', auth()->user()->member->company_id);
            }),]
        ];
    }
}
