<!doctype html>
<html>
@include('layout.head')
<body onload="start()" data-type="index">
<div class="tpl-page-container tpl-page-header-fixed">
@include('layout.nav')
@include('layout.list')
@yield('content')
</div>
<div id="footer" class="container">
    <nav class="navbar navbar-default navbar-fixed-bottom">
        <div class="navbar-inner navbar-content-center">
            <p class="text-muted credit" style="padding: 10px; text-align: center">
                Powered by <a href="http://www.fyguoji.cn">Fred Chen</a>
            </p>
        </div>
    </nav>
</div>
</body>
@include('layout.foot')
@yield('_js')
</html>
