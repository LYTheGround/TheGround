<?php

namespace App\Http\Requests\Deal;

use App\Rules\FaxRule;
use App\Rules\TelRule;
use Illuminate\Foundation\Http\FormRequest;

class DealRequest extends FormRequest
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
            'name'          =>  'required|string|min:3|max:25',
            'email'         =>  'required|email',
            'fax'           =>  ['nullable','min:10','max:10', new FaxRule()],
            'speaker'       =>  'required|string|min:3|max:25',
            'tel'           =>  ['required','min:10','max:10', new TelRule()],
            'address'       =>  'required|string|min:10|max:50',
            'build'         =>  'required|int',
            'floor'         =>  'nullable|int',
            'apt_nbr'       =>  'nullable|int',
            'zip'           =>  'nullable|int',
            'city_id'       =>  'nullable|int|exists:cities,id',
            'description'   =>  'nullable|string|min:10',
        ];
    }
}
