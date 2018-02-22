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
            修改{{$webConfig->name}}的信息
        </div>
        <ol class="am-breadcrumb">
            <li><a href="#" class="am-icon-home">首页</a></li>
            <li><a href="#">配置</a></li>
            <li class="am-active">网站配置</li>
        </ol>
        <div class="tpl-portlet-components">
            <div class="portlet-title">
                <div class="caption font-green bold">
                    <span class="am-icon-code" id="information">代码撸多，人精神~</span>
                </div>
            </div>
            <div class="tpl-block ">

                <div class="am-g tpl-amazeui-form">
                    <div class="am-u-sm-12 am-u-md-9">

                        <form class="am-form am-form-horizontal ">
                            <div class="am-form-group">
                                <label for="user-name" class="am-u-sm-3 am-form-label">网站名称 / Name</label>
                                <div class="am-u-sm-9">
                                    <input type="text" name="name" placeholder="姓名 / Name" value="{{$webConfig->name}}">
                                </div>
                            </div>

                            <div class="am-form-group">
                                <label for="user-email" class="am-u-sm-3 am-form-label">网站关键字/ keywords</label>
                                <div class="am-u-sm-9">
                                    <input type="text" name="keywords" placeholder="逗号分隔即可 / Email" value="{{$webConfig->keywords}}">
                                </div>
                            </div>

                            <div class="am-form-group">
                                <label for="user-email" class="am-u-sm-3 am-form-label">网站备案号/ beian</label>
                                <div class="am-u-sm-9">
                                    <input type="text" name="beian" placeholder="备案这东西。。。 / Email" value="{{$webConfig->beian}}">
                                </div>
                            </div>


                            <div class="am-form-group">
                                <label for="user-email" class="am-u-sm-3 am-form-label">网站Logo / Logo</label>
                                <div class="am-u-sm-9">
                                    {{--logo上传--}}
                                    <div class="form-group">
                                        <div class="col-sm-10">
                                            <div class="input-group">
                                                <label type="button" class="am-btn am-btn-danger am-btn-sm" for="logo_upload">
                                                    <i class="am-icon-cloud-upload"></i> 选择文件</label>
                                                <div hidden>
                                                    <input id="logo_upload" type="file" name="logo" data-url="/admin/logo_upload" multiple >
                                                </div>
                                                <div id="show"></div>
                                                <input type="hidden" value="{{asset($webConfig->logo)}}" id="logo_input" name="logo_input">
                                                <button id="logo_submit" class="am-btn am-btn-success am-btn-sm" onclick="return false" hidden>
                                                </button>
                                            </div>
                                            <div class="input-group" style="margin-top:5px;">
                                                <img src="{{asset($webConfig->logo)}}"
                                                     class="img-responsive img-thumbnail" width="150" id="logo">
                                            </div>
                                        </div>

                                        <script>
                                            $.ajaxSetup({
                                                headers: {
                                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                                }
                                            });
                                            $('#logo_upload').fileupload({
                                                dataType: 'json',
                                                add: function (event, data) {
                                                    data.context = $('#logo_submit').show().text('点击上传')
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
                                                    $('#logo').attr('src',response.path);
                                                    $('#logo_upload').attr('src',response.path);
                                                    $('#logo_input').val(response.path);

                                                }

                                            });
                                        </script>
                                    </div>
                                    {{--logo上传结束--}}
                                </div>
                            </div>

                            <div class="am-form-group">
                                <label for="user-intro" class="am-u-sm-3 am-form-label">简介 / Intro</label>
                                <div class="am-u-sm-9">
                                    <textarea class="" rows="5" id="description" placeholder="输入网站简介">{{$webConfig->description}}</textarea>
                                </div>
                            </div>

                            <div class="am-form-group">
                                <div class="am-u-sm-9 am-u-sm-push-3">
                                    <a type="button" class="am-btn am-btn-primary" href="javascript:;" onclick="postInfo()">保存修改</a>
                                </div>
                            </div>
                        </form>
                    </div>
                    @include('modal.success')
                    {{--这里放异步的模态框，有点丑，但是方法简单哈哈哈--}}
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
            let keywords = $('input[name=keywords]').val();
            let logo = $('input[name=logo_input]').val();
            let beian = $('input[name=beian]').val();
            let description = $('#description').val();
            $.ajax({
                url: '/admin/config_web',
                data: {
                    'name':name,
                    'keywords':keywords,
                    'logo':logo,
                    'description': description,
                    'beian':beian
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