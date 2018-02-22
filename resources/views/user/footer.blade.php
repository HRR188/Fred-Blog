@include('modal.success')
@include('modal.ajaxPost')
@include('modal.ajaxInput')
@include('modal.ajaxInfo')
@include('modal.ajaxComment')
@include('modal.success_front')
<input type="hidden" name="url" value="{{$_SERVER['HTTP_HOST']}}"/>
<footer class="blog-footer" style="padding-bottom: 0;margin-top: 0" >
    <section class="canvas-wrap" style="margin-bottom: 22px">
        <div class="canvas-content ">
            <button data-am-smooth-scroll class="am-btn am-btn-success back-top" id="back-top">top</button>
            <div class="blog-text-center">Licensed under MIT license. {{$webConfig->beian}}</div>
            <div> Made with love By Fred Chen.</div>
        </div>
        <div id="canvas" class="gradient">
        </div>
    </section>

    <script src="http://cdn.staticfile.org/modernizr/2.8.3/modernizr.js"></script>
    <script src="/js/three.min.js"></script>
    <script src="/js/projector.js"></script>
    <script src="/js/canvas-renderer.js"></script>
    <script src="/js/color.js"></script>
    <script src="/js/3d-lines-animation.js"></script>
    <script src="/assets_admin/js/amazeui.ie8polyfill.min.js"></script>
    <script src="/assets_admin/js/amazeui.js"></script>
    <script src="/js/fred_blog.js"></script>
    <script src="/js/fred_front.js"></script>
</footer>
