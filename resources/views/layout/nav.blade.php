<header class="am-topbar am-topbar-inverse admin-header">
    <div class="am-topbar-brand">
        <a href="javascript:;" class="tpl-logo">
            <img src="/assets_admin/img/fred.png" alt="">
        </a>
    </div>

    <div class="am-collapse am-topbar-collapse" id="topbar-collapse">

        <ul class="am-nav am-nav-pills am-topbar-nav am-topbar-right admin-header-list tpl-header-list">

            <li class="am-dropdown" data-am-dropdown data-am-dropdown-toggle>
                <a class="am-dropdown-toggle tpl-header-list-link" href="javascript:;">
                    <span class="am-icon-comment-o"></span> 消息 <span class="am-badge tpl-badge-danger am-round">{{count($newComments)}}</span></span>
                </a>
                <ul class="am-dropdown-content tpl-dropdown-content">
                    <li class="tpl-dropdown-content-external">
                        <h3>你有 <span class="tpl-color-danger" id="notice_count">{{count($newComments)}}</span> 条新消息</h3><a href="###">全部</a></li>
                    @foreach($newComments as $newComment)
                    <li>
                        <a href="javascript:;" class="tpl-dropdown-content-message"   onclick="showComment('{{$newComment->id}}','{{$newComment->post->title}}','{{$newComment->created_at}}',
                                '{{$newComment->nickname}}','{{$newComment->content}}')" data-am-modal="{target: '#my-popup'}">
                            <span class="tpl-dropdown-content-photo">回复文章:</span>
                            <span class="tpl-dropdown-content-subject">
                            <span class="tpl-dropdown-content-from"> {{str_limit($newComment->post->title,5)}} </span>
                                <span class="tpl-dropdown-content-time">
                                    @php
                                    $time = strtotime($newComment->created_at->toDateTimeString());
                                    $now = time();;
                                    $pass = $now-$time;
                                    if($pass > 3600*24){
                                        echo floor($pass/3600*24).'天前';
                                    }else if($pass > 3600){
                                        echo floor($pass/3600).'小时前';
                                    }else if($pass > 60){
                                        echo floor($pass/60).'分钟前';
                                    }else{
                                        echo $pass.'秒前';
                                    }
                                    @endphp
                                </span></span>
                        </a>
                    </li>
                    @endforeach
                </ul>
            </li>

            <li class="am-dropdown" data-am-dropdown data-am-dropdown-toggle>
                <a class="am-dropdown-toggle tpl-header-list-link" href="javascript:;">
                    <span class="tpl-header-list-user-nick">{{Auth::guard('admin')->user()->name}}</span><span class="tpl-header-list-user-ico"> <img src="{{asset(Auth::guard('admin')->user()->avatar)}}"></span>
                </a>
                <ul class="am-dropdown-content">
                    <li><a href="/admin/change_info"><span class="am-icon-cog"></span> 个人设置</a></li>
                    <li><a href="/admin/change_pass"><span class="am-icon-cog"></span> 密码设置</a></li>
                    <li><a href="/admin/logout"><span class="am-icon-power-off"></span> 退出</a></li>
                </ul>
            </li>
        </ul>
    </div>
</header>

