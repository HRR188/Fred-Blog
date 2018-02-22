<section class="canvas-wrap" style="margin-bottom: 22px">
    <div class="canvas-content ">
        <div id="nav">
            <nav class="am-g am-g-fixed blog-fixed blog-nav" >
                <button class="am-topbar-btn am-topbar-toggle am-btn am-btn-sm am-btn-success am-show-sm-only blog-button " data-am-collapse="{target: '#blog-collapse'}"  > <span class="am-icon-bars"></span></button>
                <div class="am-collapse am-topbar-collapse" id="blog-collapse">
                    <ul class="am-nav am-nav-pills am-topbar-nav">
                        <li class="am-active"><a class="nav" href="/">首页</a></li>
                        <li class="am-dropdown" data-am-dropdown>
                            <a class="am-dropdown-toggle nav" data-am-dropdown-toggle href="javascript:;">
                                文章分类<span class="am-icon-caret-down"></span>
                            </a>
                            <ul class="am-dropdown-content">
                                @foreach($cates as $cate)
                                <li><a href="/cate_post/{{$cate->id}}">{{$cate->cname}}</a></li>
                                @endforeach
                            </ul>
                        </li>
                        <li><a class="nav" href="http://demo.fyguoji.cn">本博客后台演示网址</a></li>
                        <li><a class="nav" href="http://download.fyguoji.cn/blog" download="blog">下载本博客源代码</a></li>
                    </ul>
                    <div style="z-index:9999;">
                                <div class="am-u-sm-12 am-u-md-3" style="float:right">
                                    <div class="am-input-group am-input-group-sm">
                                        <input type="text" class="am-form-field" placeholder="搜索你需要的技术文章" name="search">
                                        <span class="am-input-group-btn">
            <button class="am-btn  am-btn-default am-btn-success tpl-am-btn-success am-icon-search" type="button" id="search"></button>
          </span>
                                    </div>
                                </div>
                    </div>
                </div>
            </nav>
        </div>

    </div>
    <div id="canvas" class="gradient">

    </div>
</section>
