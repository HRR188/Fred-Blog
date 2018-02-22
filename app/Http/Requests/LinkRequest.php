<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LinkRequest extends FormRequest
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
            'name'=>'required',
            'url'=>'required',
            'linklogo'=>'required'
        ];
    }

    public function messages()
    {
        return [
            'name.required'=>'友链网站名不能为空',
            'url.required'=>'url不能为空',
            'linklogo.required'=>'木有logo不好看~P个图分分钟'
        ];
    }
}
