
<div class="am-u-md-4 am-u-sm-12 blog-sidebar">
    <div class="blog-sidebar-widget blog-bor">
        <h2 class="blog-title"><span>php相关算法专栏</span></h2>
        <ul class="am-list">
            @if(isset($algorithm))
                @php
                $count = 0;
                $arr = $algorithm->posts->reverse();
                @endphp
                @foreach($arr as $v)
                    <li><a href="/post/{{$v->id}}">{{$v->title}}</a></li>
                   <div hidden>$count++</div>
                    @if($count>5)
                        @break
                    @endif
                @endforeach
            @endif
        </ul>
    </div>


    <div class="blog-clear-margin blog-sidebar-widget blog-bor am-g ">
        <h2 class="blog-title"><span>分类</span></h2>
        <div class="am-u-sm-12 blog-clear-padding">
            @foreach($cates as $cate)
                <a href="/cate_post/{{$cate->id}}" class="blog-tag">{{$cate->cname}}</a>
            @endforeach

        </div>
    </div>

    <div class="blog-clear-margin blog-sidebar-widget blog-bor am-g ">
        <h2 class="blog-title"><span>标签</span></h2>
        <div class="am-u-sm-12 blog-clear-padding">
            @foreach($tags as $tag)
                <a href="" class="blog-tag">{{$tag->name}}</a>
            @endforeach

        </div>
    </div>

    <div class="blog-sidebar-widget blog-bor" id="intro">
        <h2 class="blog-text-center blog-title"><span>博客介绍</span></h2>
        <img src="{{$webConfig->logo}}" alt="about me" class="blog-entry-img" >
        <img src="{{$webConfig->qrcode}}" alt="about me" class="blog-entry-img" style="display: none">
        <p>{{$webConfig->name}}</p>
        <p>
            {{$webConfig->description}}
        </p>
    </div>

    <div class="blog-sidebar-widget blog-bor">
        <h2 class="blog-text-center blog-title"><span>Contact ME</span></h2>
        <p>
            <a href="http://shang.qq.com/open_webaio.html?sigt=1552b9064235e461dc8fca0e2e6ee14c4dfebe6fd59c591643f95d8f5de7bc596ddbd9adf6038b9565816aba1f83343f&sigu=41731609037d69e8e274c35d187d6bc7f07cee677d4fe4607c58695aec8c80f303756f4d41d943d7&tuin=1561618920"><span class="am-icon-qq am-icon-fw am-primary blog-icon" data-am-popover="{content: '点我发起聊天', trigger: 'hover focus'}"></span></a>
            <a href="javascript:;" data-am-popover="{content: '技术问题QQ联系，对象问题微信联系', trigger: 'hover focus'}" id="weixin"><span class="am-icon-weixin am-icon-fw blog-icon"></span></a>
            <a href="" data-am-popover="{content: '下载博客全站源码去基友hub也行', trigger: 'hover focus'}"><span class="am-icon-github am-icon-fw blog-icon"></span></a>

        </p>
    </div>
</div>