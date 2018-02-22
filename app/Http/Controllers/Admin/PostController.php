<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\PostRequest;
use App\Model\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Post;
use App\Model\Tag;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //这里我喜欢只取最新的前10个文章，如果觉得有需要加个分页就行了。
        $posts = Post::orderBy('created_at', 'desc')->take(10)->get();
        $cates = Category::whereNull('pid')->get();
        return view('admin.post.post', compact('posts', 'cates'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cates = Category::whereNull('pid')->orderBy('id','desc')->get();
        $tags = Tag::all();
        return view('admin.post.postCreate', compact('cates', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        //写入post
        $post = new Post();
        $post->title = $request->title;
        $post->cate_id = $request->selected_cate;
        $post->p_image = $request->pImage_input;
        $post->content = $request->contents;
        $post->intro = $request->intro;
        $post->visit = 1;
        $post->save();

        //写入关联模型category
        $cname = Category::find($request->selected_cate)->cname;

        $cate = new Category();
        $cate->pid = $request->selected_cate;
        $cate->cname = $cname;
        $cate->post_id = $post->id;
        $cate->save();

        //添加多对多关系
        $tagIds = $request->tag_ids;
        foreach ($tagIds as $id) {
            $post->tags()->attach($id);
        }

        return redirect('/admin/post')->with('success', '添加文章成功');

    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cates = Category::whereNull('pid')->orderBy('id','desc')->get();
        $post = Post::find($id);
        $tags = Tag::all();
        return view('admin.post.postEdit', compact('post', 'tags', 'cates'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, $id)
    {
        //更新post，这里用批量更新update([....])更优雅，但我只想copy....
        $post = Post::find($id);
        $post->title = $request->title;
        $post->cate_id = $request->selected_cate;
        $post->p_image = $request->pImage_input;
        $post->content = $request->contents;
        $post->intro = $request->intro;
        $post->save();

        //更新关联模型category
        $cname = Category::find($request->selected_cate)->cname;
        $cate = Category::where('post_id', $id)->first();
        $cate->cname = $cname;
        $cate->pid = $request->selected_cate;
        $cate->save();

        //修改多对多关系，这里先得把之前的关联删掉。其实与直接撸查询构造器一球样~
        //\DB::table('post_tags')->where('post_id',$post->id)->delete();
        $post->tags()->detach();

        $tagIds = $request->tag_ids;
        //再重新构建关联
        foreach ($tagIds as $id) {
            $post->tags()->attach($id);
        }
        return redirect('/admin/post')->with('success', '修改文章成功');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        $post->comments()->delete();
        Post::where('id', $id)->delete();
        return response()->json(['code' => 200]);
    }

    //处理文章上传封面
    public function pImage(Request $request)
    {
        $path = $request->file('pImage')->store('/public/pImage');
        $path = '/storage/pImage' . substr($path, 13);
        return response()->json(['path' => $path]);
    }

    //批量删除文章
    public function postsDelete(Request $request, Post $post)
    {
        foreach ($request->posts as $post) {
            Post::where('id', $post)->delete();
            Post::find($post)->comments()->delete();
        }
        return response()->json(['code' => 200]);
    }


    //显示被删除的文章
    public function recoverPostsForm()
    {
        $posts = Post::onlyTrashed()->orderBy('deleted_at', 'desc')->paginate(20);
        return view('admin.post.recover', compact('posts'));
    }

    //批量恢复被删除的文章
    public function recoverPosts(Request $request)
    {
        foreach ($request->posts as $id) {
            Post::withTrashed()->where('id', $id)->restore();
            Post::withTrashed()->find($id)->comments()->restore();
        }
        return response()->json(['code' => 200]);
    }

    //恢复删除的一个文章
    public function recoverPost($id)
    {
        Post::withTrashed()->where('id', $id)->restore();
        Post::withTrashed()->find($id)->comments()->restore();
        return response()->json(['code' => 200]);
    }

    //返回被搜索的模型
    public function postSearch(Request $request)
    {
        $searPosts = Post::search($request->post)->orderBy('created_at','desc')->get();
        return response()->json(['searchPosts'=>$searPosts]);
    }

    //前台按照分类显示
    public function catePost($id)
    {
        if($id){
            $posts = Category::find($id)->posts()->orderBy('created_at','desc')->paginate(10);
            return view('user.catePost',compact('posts'));
        }
    }
}
