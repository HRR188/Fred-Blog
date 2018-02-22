@extends('admin.master')
@section('content')
    <div class="tpl-content-wrapper">
        <div class="tpl-content-page-title">
            分类列表
        </div>
        <ol class="am-breadcrumb">
            <li><a href="/admin/home" class="am-icon-home">首页</a></li>
            <li class="am-active">分类管理</li>
        </ol>
        <div class="tpl-portlet-components">
            <div class="portlet-title">
                <div class="caption font-green bold">
                    <span class="am-icon-code"></span> 分类列表
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
                                <a type="button" href="javascript:;" id="ajaxInput1"
                                   class="am-btn am-btn-default am-btn-success"><span class="am-icon-plus"></span>
                                    新增</a>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="am-g">
                    <div class="am-u-sm-12">
                        <form class="am-form">
                            <table class="am-table am-table-striped am-table-hover table-main">
                                <thead>
                                <tr>
                                    <th class="table-id">ID</th>
                                    <th class="table-title">分类名称(全部文章)</th>
                                    <th class="table-title">下属文章(显示最新5篇)</th>
                                    <th class="table-set">操作</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($cates as $cate)
                                    <tr class="c{{$cate->id}}">
                                        <td>{{$cate->id}}</td>

                                        <td><a href="javascript:;" onclick="showAll({{$cate->id}})"
                                               data-am-modal="{target: '#my-popup'}">{{str_limit($cate->cname,10,'...')}}</a></td>
                                        <td>
                                            @php
                                                $count = 0;
                                                $posts = $cate->posts->reverse();
                                            @endphp
                                            @foreach($posts as $post)
                                                <div hidden>{{$count++}}</div>
                                                @if($count>5)
                                                    @break
                                                @endif
                                                <li class="label label-sm label-success" style="margin-right: 3px"><a
                                                            href="/admin/post/{{$post->id}}/edit" id="showPost"
                                                            style="text-decoration: none; color: white">{{str_limit($post->title,6)}}</a>
                                                </li>

                                            @endforeach
                                        </td>
                                        <td>
                                            <div class="am-btn-toolbar">
                                                <div class="am-btn-group am-btn-group-xs">
                                                    <a href="javascript:;"
                                                       onclick="updateCate('{{$cate->id}}','{{$cate->cname}}')"
                                                       class="am-btn am-btn-default am-btn-xs am-text-secondary"
                                                       data-am-modal="{target: '#my-input'}"><span
                                                                class="am-icon-pencil-square-o"></span> 编辑</a>
                                                    <a href="javascript:;"
                                                       class="am-btn am-btn-default am-btn-xs am-text-danger am-hide-sm-only"
                                                       onclick="deleteCate({{$cate->id}})"><span
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
                </div>
            </div>
            <div class="tpl-alert"></div>
        </div>
    </div>
@endsection()
@section('_js')
    <script>
        //amaze的relatedTarget好奇怪,一直用bootstrap就好好地！不过下面做update的时候，把cname传进去岂不是更好！
        //但是和人生一样，代码也不是完美的~ 改与不改代码就在那里，无增无减~
        function showAll(id) {
            $('#my-popup').on('open.modal.amui', function () {
                $.ajax({
                    url: '/admin/this_cate/' + id,
                    dataType: 'json',
                    method: 'POST',
                    success(response) {
                        $('#my-popup').find('h4').children().empty();
                        response.posts.forEach(function (val, index) {
                            $('#my-popup').find('h4').append('<li><a href="/admin/post/{{$post->id}}/edit">' + val.title.slice(0, 10) + '...' + '</a></li>');
                        })
                    }
                })
            })

        }

        //更新cate
        function updateCate(id, cname) {
            $('#my-input').on('open.modal.amui', function () {
                $('#needName').css({'color':''});
                $(this).find('input').val(cname);
                let $confirmBtn = $(this).find('[data-am-modal-confirm]');
                let $cancelBtn = $(this).find('[data-am-modal-cancel]');
                $confirmBtn.off('click.confirm.modal.amui').on('click', function () {
                    $('#my-input').find('input').empty();
                    let name = $('.am-modal-prompt-input').val();
                    if(name){
                        $.ajax({
                            url: '/admin/cate/' + id,
                            data: {'name': name},
                            method: 'PUT',
                            dataType: 'json',
                            success(response) {
                                if (response.code === 200) {
                                    location.href = '/admin/cate'
                                } else {
                                    alert("世事无常~木有修改成功!");
                                }
                            },
                            error() {
                                alert('估计是服务器挂了~，去查查吧');
                            }
                        })
                    }else{
                       $('#needName').css({
                           'color':'red'
                       });
                        return false;
                    }
                });
                $cancelBtn.off('click.cancel.modal.amui').on('click', function() {
                    $('#needName').css({'color':''});
                });
            })

        }

        //删除一个分类（别怕是软删除~）
        function deleteCate(id) {
            if (id != 1) {
                $('#showSuccess').html('');
                let node = '<div class="am-modal am-modal-confirm" tabindex="-1" id="my-confirm">'
                    + '<div class="am-modal-dialog">'
                    + '<div class="am-modal-hd">看仔细~</div>'
                    + '<div class="am-modal-bd">老铁，删除后，下属文章就会成没爹的孩子~</div>'
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
                                url: '/admin/cate/' + id,
                                method: 'DELETE',
                                dataType: 'json',
                                success(response) {
                                    if (response.code === 200) {
                                        location.href = '/admin/cate';
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
            } else {
                $('#info').html('不能删除未分类选项');
                $('#my-alert').modal();
                setTimeout(function(){
                    $('#my-alert').modal('close');
                },2000);
            }
        }

        //新建一个分类
        $(function () {
            $('#ajaxInput1').on('click', function () {
                $('#my-input').modal({
                    relatedTarget: this,
                    onConfirm: function (e) {
                        if(e.data){
                            $.ajax({
                                url: '/admin/cate',
                                data: {'name': e.data},
                                dataType: 'json',
                                type: 'POST',
                                success(response) {
                                    if (response.code === 200) {
                                        location.href = '/admin/cate'
                                    } else {
                                        alert("世事无常~木有添加成功!")
                                    }
                                },
                                error(xhr) {
                                    //友情提示，打开xhr调试一下就行了~
                                    alert("世事无常~木有添加成功")
                                }
                            })
                        }else{
                            alert('写上分类名称吧~');
                        }

                    },
                    onCancel: function (e) {
                        e.data = null;
                    }
                });
            });
        });

    </script>
@endsection()
