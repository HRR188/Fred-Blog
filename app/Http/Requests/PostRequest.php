<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
            'title'=>'required',
            'pImage_input'=>'required',
            'selected_cate'=>'required',
            'contents'=>'required',
            'tag_ids'=>'required|array'
        ];
    }

    //中文报错
    public function messages()
    {
       return [
           'title.required'=>'请填写标题',
           'pImage_input.required'=>'请上传文章封面图',
           'selected_cate.required'=>'请选择分类',
           'contents.required'=>'请填写内容',
           'tag_ids.required'=>'请选择标签'
       ];

    }

}
