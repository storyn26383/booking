<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class Step2Request extends Request
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
            'date' => 'required|date_format:Y-m-d',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'date.required' => '請選擇訂房日期',
            'date.date_format' => '請不要破壞我的程式唷 ^.<',
        ];
    }
}
