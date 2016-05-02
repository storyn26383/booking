<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class ConfirmRequest extends Step3Request
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
        return parent::rules() + [
            'email' => 'required|email',
            'name' => 'required',
            'phone' => 'required',
            'address' => 'required',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return parent::messages() + [
            'email.required' => '請填寫 E-Mail',
            'name.required' => '請填寫姓名',
            'phone.required' => '請填寫電話',
            'address.required' => '請填寫地址',
            'email.email' => 'E-Mail 格式錯誤',
        ];
    }
}
