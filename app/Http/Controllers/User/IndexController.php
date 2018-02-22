<?php

namespace App\Http\Controllers\User;

use App\Events\postVisitCount;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Web;
use App\Model\Post;
use App\Model\Tag;
use App\Model\Category;
use App\Model\Column;
class IndexController extends Controller
{
    //显示主页
    public function index()
    {
        $posts = Post::orderBy('created_at','desc')->paginate(10);
        $tags = Tag::orderBy('created_at','desc')->get();
        $cates = Category::orderBy('created_at','desc')->whereNull('pid')->get();
        return view('user.index',compact('posts','tags','cates'));
    }

    //显示文章详情
    public function showPost($id)
    {
        //分发事件监听
        event(new postVisitCount(Post::find($id)));
        $post = Post::find($id);
        $posts = Post::all();
        $ids = [];
        foreach($posts as $v){
            array_push($ids,$v->id);
        }
        return view('user.post',compact('post','ids'));
    }

    //显示专栏文章
    public function showColumnPosts(Request $request)
    {
        $columnPosts = Column::find($request->id)->posts()->get();
        return response()->json(['columnPosts'=>$columnPosts]);
    }
}
