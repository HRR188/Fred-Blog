<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Http\Requests\AdminLogin;
use Validator;
use App\Model\Post;
class EntryController extends Controller
{
    //显示登陆界面
    public function loginForm()
    {
        return view('admin.login');
    }

    //验证登录
    public function login(Request $request)
    {
        $status = Auth::guard('admin')->attempt([
            'email' => $request->email,
            'password' => $request->password
        ]);

        if (!$status) {
            return response()->json(['message' => '用户名或密码错误', 'code' => 0]);
        } else {
            return response()->json(['code' => 200]);
        }
    }

    //后台主页
    public function home()
    {
        $posts = Post::orderBy('visit','desc')->take(10)->get();
        return view('admin.home',compact('posts'));
    }

    //登出
    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect('/admin/login');
    }

}
