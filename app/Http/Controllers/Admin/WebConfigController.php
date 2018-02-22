<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Web;
use App\Http\Requests\WebRequest;

class WebConfigController extends Controller
{
    //显示网站配置更改表达（我这里是默认值）
    public function showWebConfig()
    {
       $webConfig = Web::find(1);
       return view('admin.config.webConfig',compact('webConfig'));

    }

    //更新信息
    public function webConfig(WebRequest $request)
    {
        $webConfig = Web::find(1);
        $webConfig->name = $request->name;
        $webConfig->keywords = $request->keywords;
        $webConfig->description = $request->description;
        $webConfig->logo = asset($request->logo);
        $webConfig->beian = $request->beian;
        $webConfig->save();
        return response()->json(['code'=>200]);
    }

    //处理logo上传封面
    public function logo(Request $request)
    {
        $path = $request->file('logo')->store('/public/logo');
        $path = '/storage/logo' . substr($path, 11);
        return response()->json(['path' => $path]);
    }
}
