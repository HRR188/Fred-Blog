@extends('admin.master')
@section('content')
    <div class="tpl-content-wrapper">
        <div class="tpl-content-page-title">
            修改{{Auth::guard('admin')->user()->name}}的密码
        </div>
        <ol class="am-breadcrumb">
            <li><a href="#" class="am-icon-home">首页</a></li>
            <li><a href="#">表单</a></li>
            <li class="am-active">Amaze UI 表单</li>
        </ol>
        <div class="tpl-portlet-components">
            <div class="portlet-title">
                <div class="caption font-green bold">
                    <span class="am-icon-code" id="information">忘记密码就直接数据库改吧。。。</span>
                </div>
            </div>
            <div class="tpl-block ">

                <div class="am-g tpl-amazeui-form">
                    <div class="am-u-sm-12 am-u-md-9">

                        <form class="am-form am-form-horizontal ">
                            <div class="am-form-group">
                                <label for="user-name" class="am-u-sm-3 am-form-label">旧密码 / Password</label>
                                <div class="am-u-sm-9">
                                    <input type="text" name="password" placeholder="旧密码 / Password" >
                                </div>
                            </div>

                            <div class="am-form-group">
                                <label for="user-name" class="am-u-sm-3 am-form-label">新密码 / New Password</label>
                                <div class="am-u-sm-9">
                                    <input type="text" name="new_password" placeholder="旧密码 / Password" >
                                </div>
                            </div>
                            <div class="am-form-group">
                                <label for="user-name" class="am-u-sm-3 am-form-label">确认密码 / Password Confirmation</label>
                                <div class="am-u-sm-9">
                                    <input type="text" name="new_password_confirmation" placeholder="确认密码 / Password Confirmation" >
                                </div>
                            </div>

                            <div class="am-form-group">
                                <div class="am-u-sm-9 am-u-sm-push-3">
                                    <a type="button" class="am-btn am-btn-primary" href="javascript:;" onclick="postPass()">保存修改</a>
                                </div>
                            </div>
                        </form>
                        <div id="showInfo"></div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@include('modal.ajaxInfo');
@endsection

@section('_js')
    <script>
        //异步请求后台进行信息更新 提醒一下注意post是要带着token过去的哦
        function postPass(){
            let password = $('input[name=password]').val();
            let new_password = $('input[name=new_password]').val();
            let new_password_confirmation = $('input[name=new_password_confirmation]').val();
            $.ajax({
                url: '/admin/change_pass',
                data: {
                    'password': password,
                    'new_password': new_password,
                    'new_password_confirmation': new_password_confirmation
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