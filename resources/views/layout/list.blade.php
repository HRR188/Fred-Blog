
<div class="tpl-left-nav tpl-left-nav-hover">
    <div class="tpl-left-nav-title">
       Fred Blog Lists
    </div>
    <div class="tpl-left-nav-list">
        <ul class="tpl-left-nav-menu">
            <li class="tpl-left-nav-item">
                <a href="/admin/home" class="nav-link active">
                    <i class="am-icon-home"></i>
                    <span>首页</span>
                </a>
            </li>
            <li class="tpl-left-nav-item">
                <a href="javascript:;" class="nav-link tpl-left-nav-link-list">
                    <i class="am-icon-table"></i>
                    <span>文章</span>
                    <i class="am-icon-angle-right tpl-left-nav-more-ico am-fr am-margin-right"></i>
                </a>
                <ul class="tpl-left-nav-sub-menu">
                    <li>

                        <a href="/admin/post/create">
                            <i class="am-icon-angle-right"></i>
                            <span>发布文章</span>
                            <i class="am-icon-star tpl-left-nav-content-ico am-fr am-margin-right"></i>
                        </a>

                        <a href="/admin/post">
                            <i class="am-icon-angle-right"></i>
                            <span>文章管理</span>
                            <i class="tpl-left-nav-content tpl-badge-danger">
                               {{$pCount}}
                            </i>
                        </a>

                        <a href="/admin/cate">
                                <i class="am-icon-angle-right"></i>
                                <span>分类管理</span>
                                <i class="tpl-left-nav-content tpl-badge-primary">
                                   {{ $cCount}}
                                </i>
                        </a>

                        <a href="/admin/tag">
                            <i class="am-icon-angle-right"></i>
                            <span>标签管理</span>
                            <i class="tpl-left-nav-content tpl-badge-success">
                                {{ $tCount}}
                            </i>
                        </a>

                        <a href="/admin/column">
                            <i class="am-icon-angle-right"></i>
                            <span>专栏管理</span>
                            <i class="tpl-left-nav-content tpl-badge-danger">
                                {{  $columnCount}}
                            </i>
                        </a>
                        <a href="/admin/recover_posts">
                            <i class="am-icon-angle-right"></i>
                            <span>回收站</span>
                            <i class="tpl-left-nav-content tpl-badge-warning">
                                {{ $rCount}}
                            </i>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="tpl-left-nav-item">
                <a href="javascript:;" class="nav-link tpl-left-nav-link-list">
                    <i class="am-icon-table"></i>
                    <span>拓展</span>
                    <i class="am-icon-angle-right tpl-left-nav-more-ico am-fr am-margin-right"></i>
                </a>
                <ul class="tpl-left-nav-sub-menu">
                    <li>
                        <a href="/admin/links">
                            <i class="am-icon-angle-right"></i>
                            <span>友链管理</span>
                            <i class="tpl-left-nav-content tpl-badge-success">
                                {{ $lCount}}
                            </i>
                        </a>

                        <a href="/admin/comments">
                            <i class="am-icon-angle-right"></i>
                            <span>评论管理</span>
                            <i class="tpl-left-nav-content tpl-badge-primary">
                                {{$coCount}}
                            </i>
                        </a>

                    </li>
                </ul>
            </li>


            <li class="tpl-left-nav-item">
                <a href="javascript:;" class="nav-link tpl-left-nav-link-list">
                    <i class="am-icon-wpforms"></i>
                    <span>配置</span>
                    <i class="am-icon-angle-right tpl-left-nav-more-ico am-fr am-margin-right"></i>
                </a>
                <ul class="tpl-left-nav-sub-menu">
                    <li>
                        <a href="/admin/config_web">
                            <i class="am-icon-angle-right"></i>
                            <span>网站管理</span>
                            <i class="am-icon-star tpl-left-nav-content-ico am-fr am-margin-right"></i>
                        </a>

                    </li>
                </ul>
            </li>

            <li  class="tpl-left-nav-item">
                   <span class=" nav-link tpl-left-nav-link-list" data-close="note" id="time"></span>
           </li>
        </ul>
    </div>
</div>
