<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WebRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return \Auth::guard('admin')->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */

    public function rules()
    {
        return [
            'name' => 'required',
            'keywords' => 'required',
            'logo' => 'required',
            'description' => 'required',
            'beian' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => '网站名称不能为空',
            'keywords.required' => '关键字名称不能为空',
            'logo.required' => 'logo不能为空',
            'description.required' => '网站描述不能为空',
            'beian.required' => '网站备案不能为空'
        ];
    }
}
