<!doctype html>
<html>
<body id="blog">
@include('user.head')
@include('user.nav')
<div class="am-g am-g-fixed blog-fixed">
<!-- content srart -->
@yield('content')
@include('user.sidebar')
</div>
<!-- content end -->
@include('user.footer')
</body>
@yield('_js')
</html>