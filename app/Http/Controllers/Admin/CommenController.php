<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
class CommenController extends Controller
{
    //使用中间件进行验证
    public function __construct()
    {
        $this->middleware('admin.auth');
    }
}
