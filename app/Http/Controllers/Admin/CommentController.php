<?php

namespace App\Http\Controllers\Admin;

use App\Model\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CommentController extends Controller
{
    //显示后台评论列表(并且只取我的最新回复)
    public function comments()
    {
        $comments = Comment::whereNull('comment_id')->orderBy('created_at','desc')->paginate(20);
        $myComments = Comment::whereNotNull('isme')->get();
        foreach ($comments as $comment){
            $comment->myComment = '';
            foreach ($myComments as $myComment){
               if($myComment->comment_id == $comment->id){
                   $comment->myComment = $myComment;
               }
            }
        }
        return view('admin.comments',compact('comments'));
    }

    //更新read状态
    public function read(Request $request)
    {
        $comment = Comment::find($request->id);
        $comment->read = 1;
        $comment->save();
        return response()->json(['code'=>200]);
    }

    //admin回复对此comment回复message
    public function sendMessage(Request $request,$id)
    {
        //更新此comment的状态
        $comment = Comment::find($id);
        $comment->status = 1;
        $comment->read = 1;
        $comment->save();

        //取得关联的postId
        $post = $comment->post;
        $postId = $post->id;

        //新建Comment
        $newComment = new Comment();
        $newComment->nickname = \Auth::guard('admin')->user()->name;
        $newComment->content = $request->message;
        $newComment->post_id = $postId;
        $newComment->email = 'fredchen188@gmail.com';
        $newComment->comment_id = $id;
        $newComment->status = 1;
        $newComment->gavatar = '/assets_admin/img/fred.png';
        $newComment->read = 1;
        $newComment->isme = 1;
        $newComment->save();
        return response()->json(['code'=>200]);
    }
//
    //删除评论(并且删除此评论的评论)
    public function deleteComment($id)
    {
        Comment::where('comment_id',$id)->delete();
        Comment::destroy($id);
        return response()->json(['code'=>200]);
    }

    //前台回复对此comment回复message
    public function sendBack(Request $request,$pid,$cid)
    {
        //计算gavatar的hash函数
        $email = md5(strtolower(trim($request->email)));
        $gavtar = gravatar( $email);
        //新建Comment
        $newComment = new Comment();
        $newComment->nickname = $request->nickname;
        $newComment->content = trim($request->contents);
        $newComment->post_id = $pid;
        $newComment->email =  $request->email;
        $newComment->comment_id = $cid;
        $newComment->gavatar = $gavtar;
        $newComment->read = 0;
        $newComment->save();
        return response()->json(['code'=>200]);
    }

    //新评论
    public function sendNew(Request $request,$pid)
    {
        //计算gavatar的hash函数
        $email = md5(strtolower(trim($request->email)));
        $gavtar = gravatar( $email);
        //新建Comment
        $newComment = new Comment();
        $newComment->nickname = $request->nickname;
        $newComment->content = trim($request->contents);
        $newComment->post_id = $pid;
        $newComment->email =  $request->email;
        $newComment->gavatar = $gavtar;
        $newComment->read = 0;
        $newComment->save();
        return redirect()->back()->with('success','新回复成功，老铁么么哒~');
    }

}
