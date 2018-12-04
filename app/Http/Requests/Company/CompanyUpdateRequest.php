<?php

namespace App\Http\Requests\Company;

use App\Rules\FaxRule;
use App\Rules\TelRule;
use Illuminate\Foundation\Http\FormRequest;

class CompanyUpdateRequest extends FormRequest
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
            'brand'     => 'nullable|mimes:jpeg,png,gif,jpg,svg',
            'name'      => 'required|string|min:3|max:25|unique:info_boxes,id,' . $this->company->info_box_id,
            'tel'       => ['required','min:10','max:10',new  TelRule()],
            'fax'       => ['nullable','min:10','max:10',new FaxRule()],
            'speaker'   => 'required|string|min:3|max:15',
            'licence'   => 'nullable|string|min:5|max:25',
            'turnover'  => 'required|int|min:3|max:100000000',
            'taxes'     => 'required|int|max:100',
            'address'   => 'required|string|min:10|max:80',
            'build'     => 'required|int|min:1|max:10000',
            'floor'     => 'nullable|int|max:100',
            'apt_nbr'   => 'nullable|int|min:1|max:1000',
            'zip'       => 'required|int|min:1000|max:40000',
            'city'      => 'required|int|exists:cities,id'
        ];
    }
}
