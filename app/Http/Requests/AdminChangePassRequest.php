<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Auth;
use Hash;
use Validator;
class AdminChangePassRequest extends FormRequest
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

    //这里拓展了验证规则使用Hash类进行原始密码的验证
    public function addValidator()
    {
        Validator::extend('check_password', function ($attribute, $value, $parameters, $validator) {
            return Hash::check($value, Auth::guard('admin')->user()->password);
        });

    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $this->addValidator();
        return [
            'password' => 'required|sometimes|check_password',
            'new_password_confirmation' => 'required|sometimes',
            'new_password' => 'required|sometimes|confirmed',
        ];
    }

    public function messages()
    {
        return [
            'password.required'=>'密码不能为空',
            'password.check_password'=>'原始密码不正确',
            'new_password_confirmation.required'=>'请填写确认密码' ,
            'new_password.required'=>'新密码不能为空',
            'new_password.confirmed'=>'两次密码输入不一致'
        ];
    }
}
