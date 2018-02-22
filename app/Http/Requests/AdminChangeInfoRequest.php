<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Auth;
class AdminChangeInfoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::guard('admin')->check();
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
            'email'=>'required',
            'avatar'=>'required',
            'intro'=>'required'
        ];
    }

    //设置中文提示
    public function messages(){
        return [
          'name.required'=>'请填写昵称',
          'email.required'=>"请填写邮箱",
          'avatar.required'=>"请上传头像",
          'intro.required'=>'请填写简介'
        ];
    }
}
