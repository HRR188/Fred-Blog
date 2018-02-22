@extends('admin.master')
@section('content')
    <div class="tpl-content-wrapper">
        <div class="tpl-content-page-title">
            友链管理
        </div>
        <ol class="am-breadcrumb">
            <li><a href="/admin/home" class="am-icon-home">首页</a></li>
            <li class="am-active">友链管理</li>
        </ol>
        <div class="tpl-portlet-components">
            <div class="portlet-title">
                <div class="caption font-green bold">
                    <span class="am-icon-code"></span>友链管理
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
                                <a type="button" href="/admin/links/create" id="ajaxInput1"
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
                                    <th class="table-title">网站名称</th>
                                    <th class="table-title">网站地址</th>
                                    <th class="table-image">网站logo</th>
                                    <th class="table-set">操作</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($links as $link)
                                    <tr >
                                        <td >{{$link->id}}</td>
                                        <td >{{$link->name}}</td>
                                        <td >{{$link->created_at}}</td>
                                        <td >
                                            <a class="am-dropdown-toggle tpl-header-list-link" href="javascript:;">
                                                <span class="tpl-header-list-user-ico">
                                                 <img src="{{asset($link->logo)}}">
                                                </span>
                                            </a>
                                        </td>
                                        <td>
                                            <div class="am-btn-toolbar">
                                                <div class="am-btn-group am-btn-group-xs">
                                                    <a href="/admin/links/{{$link->id}}/edit"
                                                       class="am-btn am-btn-default am-btn-xs am-text-secondary"><span
                                                                class="am-icon-pencil-square-o"></span> 编辑</a>
                                                    <a href="javascript:;"
                                                       class="am-btn am-btn-default am-btn-xs am-text-danger am-hide-sm-only"
                                                       onclick="deleteLink({{$link->id}})"><span
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
                    @include('modal.success')
                    {{--这里放异步的模态框，有点丑，但是方法简单哈哈哈--}}
                    <div id="showSuccess"></div>
                    @include('modal.ajaxPost')
                    @include('modal.ajaxInput')
                </div>
            </div>
            <div class="tpl-alert"></div>
        </div>
    </div>
@endsection()
@section('_js')
    <script>
        //删除一个link
        function deleteLink(id) {
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
                            url: '/admin/links/' + id,
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
    </script>
@endsection()
