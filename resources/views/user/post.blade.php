@extends('user.master')
@section('content')

        <div class="am-u-md-8 am-u-sm-12 " id="index">
            <article class="am-article blog-article-p">
                <div class="am-article-hd">

                    <h1 class="am-article-title blog-text-center">{{$post->title}}</h1>

                    <p class="am-article-meta blog-text-center">
                        <span style="margin-right: 10px">发布时间：{{$post->created_at}}</span>
                        <span style="margin-right: 10px;">浏览量：{{$post->visit}}</span>
                        @foreach($post->tags as $tag)
                            <span class="label label-sm label-danger" style="margin-top: 10px">{{$tag->name}}</span>
                        @endforeach
                    </p>


                </div>
                <div class="am-article-bd">
                    <img src="" alt="" class="blog-entry-img blog-article-margin">
                    <p class="am-article-lead">
                    摘要
                    <blockquote><p><em>
                                {!! $post->intro !!}</em>
                        </p></blockquote>
                    <p>
                        {!! $post->content !!}
                    </p>

                </div>
            </article>
            <hr>

            @php
            $index = array_search($post->id,$ids);
            $count = count($ids);
            @endphp
            <ul class="am-pagination blog-article-margin">
                @if($index > 0)
                    <li class="am-pagination-prev"><a href="/post/{{$ids[$index-1]}}" class="">&laquo;上一篇文章</a></li>
                @endif
                @if($index+1 < $count)
                <li class="am-pagination-next"><a href="/post/{{$ids[$index+1]}}">下一篇文章 &raquo;</a></li>
                @endif
            </ul>
            <hr>

            <form class="am-form am-g" method="POSt" action="/send_new/{{$post->id}}">
                {{csrf_field()}}
                <h3 class="blog-comment">发表新评论</h3>
                <fieldset>
                    <div class="am-form-group am-u-sm-4 blog-clear-left">
                        <input type="text" class="" placeholder="怎么称呼您？" name="nickname" required>
                    </div>
                    <div class="am-form-group am-u-sm-4">
                        <input type="email" class="" placeholder="电邮不会公开" name="email" required>
                    </div>
                    <div class="am-form-group">
                        <textarea class="" rows="5" name="contents" required="true">

                        </textarea>
                    </div>
                    <p><button type="submit" class="am-btn am-btn-default">发表评论</button></p>
                </fieldset>
            </form>
            <hr>

            {{--回复评论列表--}}
            <ul class="am-comments-list am-comments-list-flip">
                @foreach($post->comments as $comment)
            <li class="am-comment">
                <img src="{{$comment->gavatar}}" alt="" class="am-comment-avatar" width="48" height="48"/>
                <div class="am-comment-main">
                    <header class="am-comment-hd">
                        <div class="am-comment-meta">
                            <a name="{{$comment->id}}" class="am-comment-author">{{$comment->nickname}}</a>
                            @if($comment->comment_id)
                                @foreach($post->comments as $value)
                                    @if($value->id == $comment->comment_id)
                                        <a href="#{{$value->id}}" style="color:orangered">  @ {{$value->nickname}} </a>
                                    @break
                                    @endif
                                @endforeach
                            @endif
                            评论于 <time title="{{$comment->created_at}}">{{$comment->created_at}}</time>
                            <span class="am-btn-group am-btn-group-xs" style="position: relative; float: right">

                            <a href="javascript:;"
                           onclick="sendBack('{{$post->id}}','{{$comment->id}}')"
                           class="am-btn am-btn-default am-btn-xs am-text-secondary"
                           data-am-modal="{target: '#my-comment'}"><span
                           class="am-icon-pencil-square-o"></span> 回复</a>

                    </span>
                        </div>
                    </header>

                    <div class="am-comment-bd">
                       {!! $comment->content !!}
                    </div>
                </div>
            </li>
                    @endforeach
            </ul>
            {{--评论列表结束--}}
        </div>

    @endsection
@section('_js')
    <script>
        function sendBack(pid,cid) {
            $('#my-comment').on('open.modal.amui', function () {
                $('#my-comment').find('.am-modal-btn').off('click.close.modal.amui');
                let $confirmBtn = $(this).find('[data-am-modal-confirm]');
                let $cancelBtn = $(this).find('[data-am-modal-cancel]');
                $confirmBtn.off('click.confirm.modal.amui').on('click', function(event) {
                    let nickname = $('#am-modal-prompt-input1').val();
                    let email = $('#am-modal-prompt-input2').val();
                    let content = $('#am-modal-prompt-input3').val();
                    if(nickname && email && content){
                        $('#my-comment').removeData('amui.modal');
                        $.ajax({
                            url: '/send_back/' + pid +'/'+ cid,
                            method: 'POST',
                            dataType: 'json',
                            data:{
                                'nickname':nickname,
                                'email':email,
                                'contents':content
                            },
                            success(response) {
                                if (response.code === 200) {
                                    location.href = '/post/'+pid
                                } else {
                                    alert("世事无常~木有回复成功啊!");
                                }
                            },
                            error() {
                                alert('估计是服务器挂了~，去查查吧');
                            }
                        })
                    }else{
                        $('#my-comment').find('.am-modal-btn').off('click.close.modal.amui');
                        $('#need-info').html('您不填写信息，老浩真没法往数据库插关联记录啊。。。');

                    }
                });
                $cancelBtn.off('click.cancel.modal.amui').on('click', function(event) {
                    $('#need-info').html('');
                    $(this).removeData('amui.modal');
                    $('#my-comment').modal('close')
                });
            })

        }



        $(function(){
            $( ".tool-button" ).click(function() {
                $(this).toggleClass( "active" );
                $(".icons").toggleClass( "open" );
            });
        })

    </script>
@endsection