<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>写点代码洗洗睡</title>
    <meta name="description" content="没啥比写代码更快乐的，如果有那就是找到了bug...">
    <meta name="keywords" content="index">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="renderer" content="webkit">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <link rel="icon" type="image/png" href="/assets_admin/i/favicon.png">
    <link rel="apple-touch-icon-precomposed" href="/assets_admin/i/app-icon72x72@2x.png">
    <meta name="apple-mobile-web-app-title" content="Amaze UI" />
    <link rel="stylesheet" href="/assets_admin/css/amazeui.min.css" />
    <link href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" href="/assets_admin/css/admin.css">
    <link rel="stylesheet" href="/assets_admin/css/app.css">
    <script src="/js/jquery.js"></script>

</head>
<body onload="start()" data-type="index">

<body data-type="login">

<div class="am-g myapp-login">
    <div class="myapp-login-logo-block  tpl-login-max">
        <div class="myapp-login-logo-text">
            <div class="myapp-login-logo-text" id="laohao">
                <span> 老浩</span> <i class="am-icon-skyatlas"></i>

            </div>
        </div>

        <div class="login-font">
            <i>Log In </i> or <span> Sign Up</span>

        </div>
        <div class="am-u-sm-10 login-am-center">
            <form class="am-form" >
                <fieldset>
                    <div class="am-form-group">
                        <input type="email" name="email" id="doc-ipt-email-1" placeholder="电邮" required value="{{old('email')}}">
                    </div>
                    <div class="am-form-group">
                        <input type="password" name="password" id="doc-ipt-pwd-1" placeholder="密码" required>
                    </div>
                    <p><button type="submit" class="am-btn am-btn-default" id="login" >登录</button></p>
                </fieldset>
            </form>
        </div>
    </div>
</div>

@include('layout.foot')

<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $(function(){
        $('#login').click(function(event){
            event.preventDefault();
            let email = $('input[name=email]').val();
            let password = $('input[name=password]').val();
            if(!email || !password){
                let content = $('#laohao span').html();
                $('#laohao span').html('至少你得填点啥吧~');
                setTimeout(function(){
                    $('#laohao span').html(content);
                },2000);
                return false
            }
            $.ajax({
                url: '/admin/login',
                type: 'POST',
                dataType: 'json',
                data: {
                    'email': email,
                    'password': password
                },
                success(response){
                    console.log(response);
                    if(response.code === 200){
                        location.href = '/admin/home';
                    }else{
                        let content = $('#laohao span').html();
                        $('#laohao span').html(response.message);
                        setTimeout(function(){
                            $('#laohao span').html(content);
                        },2000);
                    }
                },
                error(xhr){
                    $('#error').show();
                    $('#error span').html('服务器错误，请重试');
                    setTimeout(function(){
                        $('#error').hide('slow');
                    },2000);
                }
            })
        });
    })
</script>
