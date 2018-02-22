@extends('admin.master')
@section('content')
    <div class="tpl-content-wrapper">
        <div class="tpl-content-page-title">
            回收站文章列表
        </div>
        <ol class="am-breadcrumb">
            <li><a href="/admin/home" class="am-icon-home">首页</a></li>
            <li class="am-active">回收站管理</li>
        </ol>
        <div class="tpl-portlet-components">
            <div class="portlet-title">
                <div class="caption font-green bold">
                    <span class="am-icon-code"></span>  回收站文章列表
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
                                <a type="button"  href="javascript:;" onclick="recoverPosts()" class="am-btn am-btn-default am-btn-success"><span class="am-icon-plus"></span> 批量恢复</a>
                            </div>
                        </div>
                    </div>

                    <div class="am-u-sm-12 am-u-md-3">
                        <div class="am-input-group am-input-group-sm">
                            <input type="text" class="am-form-field">
                            <span class="am-input-group-btn">
            <button class="am-btn  am-btn-default am-btn-success tpl-am-btn-success am-icon-search" type="button"></button>
          </span>
                        </div>
                    </div>
                </div>
                <div class="am-g">
                    <div class="am-u-sm-12">
                        <form class="am-form">
                            <table class="am-table am-table-striped am-table-hover table-main">
                                <thead>
                                <tr>
                                    <th class="table-check"><input type="checkbox" class="tpl-table-fz-check"></th>
                                    <th class="table-id">ID</th>
                                    <th class="table-title">标题</th>
                                    <th class="table-type">类别</th>
                                    <th class="table-author am-hide-sm-only">标签</th>
                                    <th class="table-date am-hide-sm-only">删除日期</th>
                                    <th class="table-set">操作</th>
                                </tr>
                                </thead>
                                <tbody >
                                @foreach($posts as $post)
                                    <tr class="p{{$post->cate_id}}">
                                        <td>
                                                <label>
                                                    <input type="checkbox" value="{{$post->id}}" name="item" >
                                                </label>
                                        </td>
                                        <td>{{$post->id}}</td>
                                        <td><a href="javascript:;" id="showPost">{{str_limit($post->title,10,'...')}}</a></td>
                                        <td>{{$post->category->cname}}</td>
                                        <td class="am-hide-sm-only">
                                            @foreach($post->tags as $tag)
                                                <span class="label label-sm label-danger">{{$tag->name}}</span>
                                            @endforeach

                                        </td>
                                        <td class="am-hide-sm-only">{{$post->deleted_at}}</td>
                                        <td>
                                            <div class="am-btn-toolbar">
                                                <div class="am-btn-group am-btn-group-xs">
                                                    <a href="javascript:;" onclick="recoverPost({{$post->id}})"  class="am-btn am-btn-default am-btn-xs am-text-secondary"><span class="am-icon-pencil-square-o"></span> 恢复</a>
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
                    @include('modal.success')
                    {{--这里放异步的模态框，有点丑，但是方法简单哈哈哈--}}
                    <div id="showSuccess"></div>
                    @include('modal.ajaxPost')
                    @include('modal.ajaxInfo')
                </div>
            </div>
            {{$posts->links()}}
            <div class="tpl-alert"></div>
        </div>
    </div>
@endsection()
@section('_js')

    <script>
        //批量恢复文章
        function recoverPosts(){
            let arr = [];
            $('input:checkbox[name=item]').each(function(index,val){
                if($(this).prop('checked')){
                    arr.push($(this).val());
                }
            });
            if(arr.length != 0){
                $.ajax({
                    url: '/admin/recover_posts',
                    data: {
                        'posts': arr
                    },
                    method: 'POST',
                    dataType: 'json',
                    success(response){
                        $('#showSuccess').html('');
                        if(response.code ==200){
                            let node = '<div class="am-modal am-modal-alert" tabindex="-1" id="my-success">'
                                +'<div class="am-modal-dialog">'
                                +'<div class="am-modal-hd">无聊撸代码，越撸越寂寞~</div>'
                                +'<div class="am-modal-bd">'
                                +'<li class="alert-success">批量恢复成功</li>'
                                +'</div>'
                                +'</div>'
                                +'</div>';
                            $('#showSuccess').html(node);
                            $(function(){
                                $('#my-success').modal();
                                setTimeout(function(){
                                    $('#my-success').modal('close');
                                },2000)
                            });
                            location.href = '/admin/post';
                        }else{
                            alert('估计是服务器挂了~，去查查吧');
                        }
                    },
                    error(xhr){
                        alert('估计是服务器挂了~，去查查吧');
                    }
                })
            }else{
                $('#my-alert').modal()
            }

        }

        //恢复一个文章
        function recoverPost(id){
            $('#showSuccess').html('');
            let node = '<div class="am-modal am-modal-confirm" tabindex="-1" id="my-confirm">'
                +'<div class="am-modal-dialog">'
                +'<div class="am-modal-hd">确定恢复吗？</div>'
                +'<div class="am-modal-footer">'
                +'<span class="am-modal-btn" data-am-modal-cancel>取消</span>'
                +'<span class="am-modal-btn" data-am-modal-confirm>确定</span>'
                +'</div>'
                +'</div>'
                +'</div>';
            $('#showSuccess').html(node);
            $(function(){
                $('#my-confirm').modal({
                    relatedTarget: this,
                    onConfirm: function(options) {
                        $.ajax({
                            url: '/admin/recover_post/'+id,
                            method: 'POST',
                            dataType: 'json',
                            success(response){
                                if(response.code ===200){
                                    location.href = '/admin/post';
                                }else{
                                    alert('估计是服务器挂了~，去查查吧');
                                }
                            },
                            error(xhr){
                                alert('估计是服务器挂了~，去查查吧');
                            }
                        });
                    },
                });
            })
        }
    </script>
@endsection()