@extends('admin.master')
@section('content')
    <div class="tpl-content-wrapper">
        <div class="tpl-content-page-title">
            文章列表
        </div>
        <ol class="am-breadcrumb">
            <li><a href="/admin/home" class="am-icon-home">首页</a></li>
            <li class="am-active">文章管理</li>
        </ol>
        <div class="tpl-portlet-components">
            <div class="portlet-title">
                <div class="caption font-green bold">
                    <span class="am-icon-code"></span> 文章列表
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
                                <a type="button"  href="/admin/post/create" class="am-btn am-btn-default am-btn-success"><span class="am-icon-plus"></span> 新增</a>
                                <a type="button" href="javascript:;" class="am-btn am-btn-default am-btn-danger" onclick="deletePosts()"><span class="am-icon-trash-o"></span> 删除</a>
                            </div>
                        </div>
                    </div>
                    <div class="am-u-sm-12 am-u-md-3">
                        <div class="am-form-group">

                            <select  class="form-control col-sm-1" id="cate">
                                <option value="option1">所有类别</option>
                                @foreach($cates as $cate)
                                    <option value="{{$cate->id}}">{{$cate->cname}}</option>
                                @endforeach
                            </select>
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
                                    <th class="table-date am-hide-sm-only">发布日期</th>
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
                                        <td><a href="/admin/post/{{$post->id}}/edit" id="showPost">{{str_limit($post->title,10,'...')}}</a></td>
                                        <td>{{$post->category->cname}}</td>
                                        <td class="am-hide-sm-only">
                                            @foreach($post->tags as $tag)
                                                <span class="label label-sm label-danger">{{$tag->name}}</span>
                                            @endforeach

                                        </td>
                                        <td class="am-hide-sm-only">{{$post->created_at}}</td>
                                        <td>
                                            <div class="am-btn-toolbar">
                                                <div class="am-btn-group am-btn-group-xs">
                                                    <a href="/admin/post/{{$post->id}}/edit" class="am-btn am-btn-default am-btn-xs am-text-secondary"><span class="am-icon-pencil-square-o"></span> 编辑</a>
                                                    <a href="javascript:;" class="am-btn am-btn-default am-btn-xs am-text-danger am-hide-sm-only"  onclick="deletePost({{$post->id}})"><span class="am-icon-trash-o"></span> 删除</a>
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
                </div>
            </div>
            <div class="tpl-alert"></div>
        </div>
    </div>
@endsection()
@section('_js')
    <script>
        //批量删除文章（别怕是软删除~）
        function deletePosts(){
            let arr = [];
            $('input:checkbox[name=item]').each(function(index,val){
                if($(this).prop('checked')){
                    arr.push($(this).val());
                }
            });
            if(arr.length != 0){
                $.ajax({
                    url: '/admin/posts_delete',
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
                                +'<li class="alert-success">批量删除成功</li>'
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
        //删除一个文章（别怕是软删除~）
        function deletePost(id){
            $('#showSuccess').html('');
            let node = '<div class="am-modal am-modal-confirm" tabindex="-1" id="my-confirm">'
                +'<div class="am-modal-dialog">'
                +'<div class="am-modal-hd">看仔细~</div>'
                +'<div class="am-modal-bd">老铁，确定要删除这条记录吗?</div>'
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
                            url: '/admin/post/'+id,
                            method: 'DELETE',
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
        //动态获取tobody>tr的class，相等于option.val()就显示，没有就隐藏~
        $(function(){
            $('#cate').on('change',function(){
             let c = 'p'+$(this).val();
             let arr = [];
             if(c !== 'poption1'){
                 $('tbody').children('tr').each(function(index,val){
                     if($(this).hasClass(c)){
                         $(this).show();
                     }else{
                         $(this).hide();
                     }
                 });
             }else{
                 $('tr').show();
             }
            })
        })
    </script>
@endsection()