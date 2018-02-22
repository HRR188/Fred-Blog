<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\AdminChangePassRequest;
use App\Http\Requests\AdminChangeInfoRequest;
use App\Model\Admin;
use Auth;

class ChangeController extends Controller
{
    //显示修改信息表单
    public function changeForm()
    {
        $user = \Auth::guard('admin')->user();
        return view('admin.changeForm', compact('user'));
    }

    //显示修改密码表单
    public function changePassForm()
    {
        return view('admin.changePassForm');
    }


    //修改个人信息逻辑
    public function changeInfo(AdminChangeInfoRequest $request)
    {
        $admin = Auth::guard('admin')->user();
        $admin->email = $request->email;
        $admin->name = $request->name;
        $admin->intro = $request->intro;
        $admin->avatar = $request->avatar;
        $admin->save();
        return response()->json(['code' => 200]);
    }

    //修改密码逻辑（这里我在AdminChangePassRequest里面加了原始密码的判断，各位觉得没有必要就删了）
    public function changePass(AdminChangePassRequest $request)
    {
        $admin = Auth::guard('admin')->user();
        $admin->password = bcrypt($request->password);
        $admin->save();
        return response()->json(['code' => 200]);
    }

    //处理文章上传封面
    public function avatar(Request $request)
    {
        $path = $request->file('avatar')->store('/public/avatar');
        $path = '/storage/avatar' . substr($path, 13);
        return response()->json(['path' => $path]);
    }

}
