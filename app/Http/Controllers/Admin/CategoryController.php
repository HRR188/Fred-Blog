<?php

namespace App\Http\Controllers\Admin;

use App\Model\Category;
use App\Model\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //这里只取pid为null的真实category
        $cates = Category::whereNull('pid')->orderBy('id')->get();
        return view('admin.category.cate', compact('cates'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $cate = new Category();
        $cate->cname = $request->name;
        $cate->save();
        return response()->json(['code' => 200]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        Category::where('id', $id)->update(['cname' => $request->name]);
        Category::where('pid', $id)->update(['cname' => $request->name]);
        return response()->json(['code' => 200]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //先查出Pid=$id的分类与文章的关联记录删掉它
        Category::where('pid', $id)->delete();
        //真实的分类也删掉
        Category::where('id', $id)->delete();
        //再将对应的文章cate_id干掉
        Post::where('cate_id', $id)->update(['cate_id' => 1]);
        return response()->json(['code' => 200]);
    }

    //实在认为amaze的钩子有bug，重复要数据不是一个好方法。认为我错的同学别这样写啊~
    public function showAllPosts($id)
    {
        $posts = Post::where('cate_id', $id)->orderBy('updated_at', 'desc')->get();
        return response()->json(['posts' => $posts]);
    }
}
