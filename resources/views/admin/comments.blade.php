@extends('admin.master')
@section('content')
    <div class="tpl-content-wrapper">
        <div class="tpl-content-page-title">
            评论管理
        </div>
        <ol class="am-breadcrumb">
            <li><a href="/admin/home" class="am-icon-home">首页</a></li>
            <li class="am-active">评论管理</li>
        </ol>
        <div class="tpl-portlet-components">
            <div class="portlet-title">
                <div class="caption font-green bold">
                    <span class="am-icon-code"></span>评论管理
                </div>
                <div class="tpl-portlet-input tpl-fz-ml">
                    <div class="portlet-input input-small input-inline">
                    </div>
                </div>
            </div>

            <div class="tpl-block" id="app">

                <div class="am-g">
                    <div class="am-u-sm-12 am-u-md-6">
                        <div class="am-btn-toolbar">
                            <div class="am-btn-group am-btn-group-xs">
                                <a type="button" href="javascript:;" id="no"
                                   class="am-btn am-btn-default am-btn-danger show " >
                                    只看未回复的评论</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="am-g">
                    <span class="am-u-sm-12">
                        <form class="am-form">
                            <table class="am-table am-table-striped am-table-hover table-main">
                                <thead>
                                <tr>
                                    <th class="table-id">ID</th>
                                    <th class="table-id">文章名称</th>
                                    <th class="table-title">网友昵称</th>
                                    <th class="table-title">网友电邮</th>
                                    <th class="table-title">评论内容</th>
                                    <th class="table-title">目前状态</th>
                                    <th class="table-title">我的回复</th>
                                    <th class="table-title">评论时间</th>
                                    <th class="table-set">操作</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($comments as $comment)
                                    <tr >
                                        <td >{{$comment->id}}</td>
                                        <td ><a href="/admin/post/{{$comment->post->id}}/edit">{{str_limit(str_pad($comment->post->title,15,'.'),10,'...')}}</a></td>
                                        <td >{{$comment->nickname}}</td>
                                        <td >{{$comment->email}}</td>
                                        <td >
                                            <div class="am-btn-group am-btn-group-xs">
                                                <a type="button" href="javascript:;"
                                                   data-am-modal="{target: '#my-popup'}"
                                                   class="am-btn am-btn-default am-btn-warning"
                                                   onclick="showComment('{{$comment->id}}','{{$comment->post->title}}','{{$comment->created_at}}',
                                                           '{{$comment->nickname}}','{{$comment->content}}')">
                                                    点我查看</a>
                                            </div>
                                        </td>

                                        <td >
                                        @if($comment->status == 1)
                                           <span class="label label-sm label-success">已回复</span>
                                        @else
                                            <span class="label label-sm label-danger"> 未回复</span>
                                         @endif
                                        </td>
                                         <td>
                                            @if($comment->myComment && $comment->status == 1)
                                                 <div class="am-btn-group am-btn-group-xs">
                                                <a type="button" href="javascript:;"
                                                   data-am-modal="{target: '#my-popup'}"
                                                   class="am-btn am-btn-default am-btn-success"
                                                   onclick="myComment('{{$comment->myComment->content}}','{{$comment->myComment->created_at}}')">
                                                 我的最新回复</a>
                                             </div>
                                                @endif
                                          </td>

                                        <td>
                                            {{$comment->created_at}}
                                        </td>
                                        <td>
                                            <div class="am-btn-toolbar">
                                                <div class="am-btn-group am-btn-group-xs">
                                                    <a href="javascript:;"
                                                       class="am-btn am-btn-default am-btn-xs am-text-secondary" onclick="sendMessage   ({{$comment->id}})" id="message">
                                                        <span class="am-icon-pencil-square-o"></span>回复</a>
                                                    <a href="javascript:;"
                                                       class="am-btn am-btn-default am-btn-xs am-text-danger am-hide-sm-only"
                                                       onclick="deleteComment({{$comment->id}})"><span
                                                                class="am-icon-trash-o"></span> 删除</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <hr>
                        </form>
                    </div>
                    <div id="showSuccess"></div>
                @include('modal.ajaxText')
                </div>
            </div>
            <div class="tpl-alert"></div>
        </div>
    </div>
@endsection()
@section('_js')
    <script>
        //只看未回复的评论与全部评论切换
        $(function(){
           $('#no').on('click',function(){
            if($(this).hasClass('show')){
                $('.label-success').parent().parent().hide();
                $(this).removeClass('show am-btn-danger').addClass('no am-btn-success').text('查看全部评论');
            }else{
                $('tr').show();
                $(this).removeClass('no am-btn-success').addClass('show am-btn-danger').text('只看未回复评论');
            }
           })
        });
        //删除一个comment
        function deleteComment(id) {
            $('#showSuccess').html('');
            let node = '<div class="am-modal am-modal-confirm" tabindex="-1" id="my-confirm">'
                + '<div class="am-modal-dialog">'
                + '<div class="am-modal-hd">看仔细~</div>'
                + '<div class="am-modal-bd">删了这个坏评论~</div>'
                + '<div class="am-modal-footer">'
                + '<span class="am-modal-btn" data-am-modal-cancel>取消</span>'
                + '<span class="am-modal-btn" data-am-modal-confirm>确定</span>'
                + '</div>'
                + '</div>'
                + '</div>';
            $('#showSuccess').html(node);
            $(function () {
                $('#my-confirm').modal({
                    relatedTarget: this,
                    onConfirm: function (options) {
                        $.ajax({
                            url: '/admin/comment/' + id,
                            method: 'DELETE',
                            dataType: 'json',
                            success(response) {
                                if (response.code === 200) {
                                    location.href = '/admin/links';
                                } else {
                                    alert('估计是服务器挂了~，去查查吧');
                                }
                            },
                            error(xhr) {
                                alert('估计是服务器挂了~，去查查吧');
                            }
                        });
                    },
                });
            })
        }
       //回复
        function sendMessage(id){
            $('#my-text').modal({
                relatedTarget: this,
                onConfirm: function (e) {
                    if(e.data){
                        $.ajax({
                            url: '/admin/comment_send_message/'+id,
                            data: {'message': e.data},
                            dataType: 'json',
                            type: 'POST',
                            success(response) {
                                e.data = null;
                                if (response.code === 200) {
                                    location.href = '/admin/comments'
                                } else {
                                    alert("世事无常~木有回复成功!")
                                }
                            },
                            error(xhr) {
                                //友情提示，打开xhr调试一下就行了~
                                console.log(xhr)
                                alert("世事无常~木有回复成功")
                            }
                        })
                    }else{
                        alert('熏弟，不写东西咋回复呢~');
                    }
                },
                onCancel: function (e) {
                    e.data = null;
                }
            });
        }
        //查看我的最新一条回复
        function myComment(content,time){
            console.log(content)
            $('#my-popup').on('open.modal.amui', function () {
                $(this).find('h4').html('我的最新回复');
                $(this).find('p').children().empty();
                $(this).find('p').append(
                    '<li><article class="am-comment">'+
                    '<div class="am-comment-main">'+
                    '<header class="am-comment-hd">'+
                    '<div class="am-comment-meta">'+
                    '回复于 <time datetime="">'+time+'</time>'+
                    '</div>'+
                    '</header>'+
                    '<div class="am-comment-bd">'+content+'</div>'+
                    '</div>'+
                    '</article></li>');
            });
            $('#my-popup').on('closed.modal.amui',function(){

            });
        }
        //删除一条回复
        function deleteComment(id){
            $('#showSuccess').html('');
            let node = '<div class="am-modal am-modal-confirm" tabindex="-1" id="my-confirm">'
                + '<div class="am-modal-dialog">'
                + '<div class="am-modal-hd">确定？</div>'
                + '<div class="am-modal-bd">网友会伤心的:(</div>'
                + '<div class="am-modal-footer">'
                + '<span class="am-modal-btn" data-am-modal-cancel>取消</span>'
                + '<span class="am-modal-btn" data-am-modal-confirm>确定</span>'
                + '</div>'
                + '</div>'
                + '</div>';
            $('#showSuccess').html(node);
            $(function () {
                $('#my-confirm').modal({
                    relatedTarget: this,
                    onConfirm: function (options) {
                        $.ajax({
                            url: '/admin/comment_delete/' + id,
                            method: 'post',
                            dataType: 'json',
                            success(response) {
                                if (response.code === 200) {
                                    location.href = '/admin/comments';
                                } else {
                                    alert('估计是服务器挂了~，去查查吧');
                                }
                            },
                            error(xhr) {
                                alert('估计是服务器挂了~，去查查吧');
                            }
                        });
                    },
                });
            })
        }
    </script>
@endsection()
