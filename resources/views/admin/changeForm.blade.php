@extends('admin.master')
@section('content')
    {{--这里使用了fileupload，因为我懒就直接在本页面引用了--}}
    {{--需要将jquery.ui放在最前面运行--}}
    <script src="/js/jquery.js"></script>
    <script src="/js/jquery.ui.widget.js"></script>
    <script src="https://cdn.bootcss.com/jqueryui/1.12.0/jquery-ui.js"></script>
    <script src="/js/jquery.fileupload.js"></script>
    <script src="/js/jquery.fileupload-process.js"></script>
    <script src="/js/jquery.fileupload-image.js"></script>
    <script src="/js/jquery.iframe-transport.js"></script>
    {{--为了隐藏上传文件Input的默认文字--}}
    <style>
        input[type="file"] {
            color: transparent;
        }
    </style>

    <div class="tpl-content-wrapper">
        <div class="tpl-content-page-title">
            修改{{$user->name}}的信息
        </div>
        <ol class="am-breadcrumb">
            <li><a href="#" class="am-icon-home">首页</a></li>
            <li><a href="#">表单</a></li>
            <li class="am-active">Amaze UI 表单</li>
        </ol>
        <div class="tpl-portlet-components">
            <div class="portlet-title">
                <div class="caption font-green bold">
                    <span class="am-icon-code" id="information">记着换个帅头像</span>
                </div>
            </div>
            <div class="tpl-block ">

                <div class="am-g tpl-amazeui-form">
                    <div class="am-u-sm-12 am-u-md-9">

                        <form class="am-form am-form-horizontal ">
                            <div class="am-form-group">
                                <label for="user-name" class="am-u-sm-3 am-form-label">姓名 / Name</label>
                                <div class="am-u-sm-9">
                                    <input type="text" name="name" placeholder="姓名 / Name" value="{{$user->name}}">
                                </div>
                            </div>

                            <div class="am-form-group">
                                <label for="user-email" class="am-u-sm-3 am-form-label">电子邮件 / Email</label>
                                <div class="am-u-sm-9">
                                    <input type="email" name="email" placeholder="输入你的电子邮件 / Email" value="{{$user->email}}">
                                </div>
                            </div>
                            <div class="am-form-group">
                                <label for="user-email" class="am-u-sm-3 am-form-label">头像 / Avatar</label>
                                <div class="am-u-sm-9">
                                    {{--头像图片上传--}}
                                    <div class="form-group">
                                        <div class="col-sm-10">
                                            <div class="input-group">
                                                <label type="button" class="am-btn am-btn-danger am-btn-sm" for="avatar_upload">
                                                    <i class="am-icon-cloud-upload"></i> 选择文件</label>
                                                <div hidden>
                                                <input id="avatar_upload" type="file" name="avatar" data-url="/admin/avatar_upload" multiple >
                                                </div>
                                                <div id="show"></div>
                                                <input type="hidden" value="{{asset($user->avatar)}}" id="avatar_input" name="avatar_input">
                                                <button id="avatar_submit" class="am-btn am-btn-success am-btn-sm" onclick="return false" hidden>
                                                </button>
                                            </div>
                                            <div class="input-group" style="margin-top:5px;">
                                                <img src="{{asset($user->avatar)}}"
                                                     class="img-responsive img-thumbnail" width="150" id="avatar">
                                            </div>
                                        </div>

                                        <script>
                                            $.ajaxSetup({
                                                headers: {
                                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                                }
                                            });
                                            $('#avatar_upload').fileupload({
                                                dataType: 'json',
                                                add: function (event, data) {
                                                    data.context = $('#avatar_submit').show().text('点击上传')
                                                        .appendTo('#show')
                                                        .click(function (event) {
                                                            data.context = $('<p/>').text('上传中...').replaceAll($(this));
                                                            data.submit();
                                                        });
                                                },
                                                done: function (e, data) {
                                                    data.context.text('上传完成.');
                                                    setTimeout(function(){
                                                        $('#show').hide('slow');
                                                    })
                                                },
                                                success: function(response){
                                                    $('#avatar').attr('src',response.path);
                                                    $('#avatar_upload').attr('src',response.path);
                                                    $('#avatar_input').val(response.path);

                                                }

                                            });
                                        </script>
                                    </div>
                                    {{--头像图片上传结束--}}
                                </div>
                            </div>

                            <div class="am-form-group">
                                <label for="user-intro" class="am-u-sm-3 am-form-label">简介 / Intro</label>
                                <div class="am-u-sm-9">
                                    <textarea class="" rows="5" id="intro" placeholder="输入个人简介">{{$user->intro}}</textarea>
                                </div>
                            </div>

                            <div class="am-form-group">
                                <div class="am-u-sm-9 am-u-sm-push-3">
                                    <a type="button" class="am-btn am-btn-primary" href="javascript:;" onclick="postInfo()">保存修改</a>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div id="showInfo"></div>
                </div>
            </div>

        </div>
    </div>
@include('modal.ajaxInfo');
@endsection
@section('_js')
    <script>
        //异步请求后台进行信息更新 提醒一下注意post是要带着token过去的哦
        function postInfo(){
            let name = $('input[name=name]').val();
            let email = $('input[name=email]').val();
            let avatar = $('input[name=avatar_input]').val();
            let intro = $('#intro').val();
            $.ajax({
                url: '/admin/change_info',
                data: {
                    'name':name,
                    'email':email,
                    'avatar':avatar,
                    'intro': intro
                },
                dataType:'json',
               method: 'POST',
                success(response){
                    $('#showInfo').html('');
                    if(response.code ==200){
                        let node = '<div class="am-modal am-modal-alert" tabindex="-1" id="my-success">'
                            +'<div class="am-modal-dialog">'
                            +'<div class="am-modal-hd">无聊撸代码，越撸越寂寞~</div>'
                            +'<div class="am-modal-bd">'
                            +'<li class="alert-success">修改信息成功</li>'
                            +'</div>'
                            +'</div>'
                            +'</div>';
                        $('#showInfo').html(node);
                        $(function(){
                            $('#my-success').modal();
                            setTimeout(function(){
                                $('#my-success').modal('close');
                            },2000)
                        })
                    }
                },
               error(xhr){
                    $(function(){
                        let json = JSON.parse(xhr.responseText);
                        errors = json.errors;
                        $('#my-alert').modal();
                        $('#info').children().html('');
                        for(let data in errors){
                            $('#info').append('<li>'+errors[data][0]+'</li>');
                            setTimeout(function(){
                                $('#my-alert').modal('close');
                            },2500)
                        }
                    });

                }
            })
        }
    </script>
@endsection()