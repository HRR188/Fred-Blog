@extends('admin.master')
@section('content')
    <div class="tpl-content-wrapper">
        <div class="tpl-content-page-title">
            标签管理
        </div>
        <ol class="am-breadcrumb">
            <li><a href="/admin/home" class="am-icon-home">首页</a></li>
            <li class="am-active">标签管理</li>
        </ol>
        <div class="tpl-portlet-components">
            <div class="portlet-title">
                <div class="caption font-green bold">
                    <span class="am-icon-code"></span>     标签管理
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
                                    <th class="table-title">标签名称</th>
                                    <th class="table-title">创建日期</th>
                                    <th class="table-set">操作</th>
                                </tr>
                                </thead>
                                <tbody>
                                 @foreach($tags as $tag)
                                     <tr >
                                     <td >{{$tag->id}}</td>
                                     <td >{{$tag->name}}</td>
                                     <td >{{$tag->created_at}}</td>
                                     <td>
                                         <div class="am-btn-toolbar">
                                             <div class="am-btn-group am-btn-group-xs">
                                                 <a href="javascript:;"
                                                    onclick="updateTag('{{$tag->id}}','{{$tag->name}}')"
                                                    class="am-btn am-btn-default am-btn-xs am-text-secondary"
                                                    data-am-modal="{target: '#my-input'}"><span
                                                             class="am-icon-pencil-square-o"></span> 编辑</a>
                                                 <a href="javascript:;"
                                                    class="am-btn am-btn-default am-btn-xs am-text-danger am-hide-sm-only"
                                                    onclick="deleteTag({{$tag->id}})"><span
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
        //更新Tag
        function updateTag(id, name) {
            $('#my-input').on('open.modal.amui', function () {
                $('#needName').css({'color':''});
                $(this).find('input').val(name);
                let $confirmBtn = $(this).find('[data-am-modal-confirm]');
                let $cancelBtn = $(this).find('[data-am-modal-cancel]');
                $confirmBtn.off('click.confirm.modal.amui').on('click', function () {
                    $('#my-input').find('input').empty();
                    let name = $('.am-modal-prompt-input1').val();
                    if(name){
                        $.ajax({
                            url: '/admin/tag/' + id,
                            data: {'name': name},
                            method: 'PUT',
                            dataType: 'json',
                            success(response) {
                                if (response.code === 200) {
                                    location.href = '/admin/tag'
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

        //删除一个Tag
        function deleteTag(id) {
                $('#showSuccess').html('');
                let node = '<div class="am-modal am-modal-confirm" tabindex="-1" id="my-confirm">'
                    + '<div class="am-modal-dialog">'
                    + '<div class="am-modal-hd">看仔细~</div>'
                    + '<div class="am-modal-bd">不知道该吐槽啥了~</div>'
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
                                url: '/admin/tag/' + id,
                                method: 'DELETE',
                                dataType: 'json',
                                success(response) {
                                    if (response.code === 200) {
                                        location.href = '/admin/tag';
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

        //新建一个标签
        $(function () {
            $('#ajaxInput1').on('click', function () {
                $('#my-input').modal({
                    relatedTarget: this,
                    onConfirm: function (e) {
                        if(e.data){
                            $.ajax({
                                url: '/admin/tag',
                                data: {'name': e.data},
                                dataType: 'json',
                                type: 'POST',
                                success(response) {
                                    if (response.code === 200) {
                                        location.href = '/admin/tag'
                                    } else {
                                        alert("世事无常~木有新建成功!")
                                    }
                                },
                                error(xhr) {
                                    //友情提示，打开xhr调试一下就行了~
                                    console.log(xhr)
                                    alert("世事无常~木有新建成功")
                                }
                            })
                        }else{
                            alert('无力吐槽~');
                        }
                    },
                    onCancel: function (e) {
                        e.data = null;
                    }
                });
            });
        });

        //修改一个标签
        $(function () {
            $('#ajaxInput2').on('click', function () {
                $('#my-input').modal({
                    relatedTarget: this,
                    onConfirm: function (e) {
                        $.ajax({
                            url: '/admin/tag',
                            data: {'name': e.data},
                            dataType: 'json',
                            type: 'POST',
                            success(response) {
                                if (response.code === 200) {
                                    location.href = '/admin/tag'
                                } else {
                                    alert("世事无常~木有添加成功!")
                                }
                            },
                            error(xhr) {
                                //友情提示，打开xhr调试一下就行了~
                                console.log(xhr);
                                alert("世事无常~木有添加成功")
                            }
                        })
                    },
                    onCancel: function (e) {

                    }
                });
            });
        });

    </script>
@endsection()
