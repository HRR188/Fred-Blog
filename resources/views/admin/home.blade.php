@extends('admin.master')
@section('content')
        <div class="tpl-content-wrapper">
            <div class="tpl-content-page-title">
                欢迎主人~
            </div>
            <ol class="am-breadcrumb">
                <li class="am-active">首页</li>
            </ol>
            <div class="row">

                <div class="am-u-md-12 am-u-sm-12 row-mb">
                    <div class="tpl-portlet">
                        <div class="tpl-portlet-title">
                            <div class="tpl-caption font-red ">
                                <i class="am-icon-bar-chart"></i>
                                <span>文章浏览量统计</span>
                            </div>
                        </div>
                        <div class="tpl-scrollable">
                            <div class="number-stats">

                                <div class="stat-number am-fr am-u-md-12">
                                    <div class="title"> Total </div>
                                    <div class="number am-text-success"> </div>
                                </div>
                            </div>

                            <table class="am-table tpl-table">
                                <thead>
                                <tr class="tpl-table-uppercase">
                                    <th>文章名称</th>
                                    <th>浏览量</th>
                                    <th>所属分类</th>
                                    <th>回复条数</th>
                                    <th>创建时间</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($posts as $post)
                                    <tr>
                                        <td>
                                            <a class="user-name" href="/admin/post/{{$post->id}}/edit">{{str_limit($post->title,20,'...')}}</a>
                                        </td>
                                        <td class="visit">{{$post->visit}}</td>
                                        <td>{{$post->category->cname}}</td>
                                        <td>{{count($post->comments)}}</td>
                                        <td class="font-green bold">{{$post->created_at->toFormattedDateString()}}</td>
                                    </tr>

                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection()
@section('_js')
    <script>
        //统计一下PV，为啥用js写？为啥视图层处理逻辑？因为随心所欲啊~代码何必写的那么教条
        $(function(){
            let pv = 0;
            $('.visit').each(function(index,element){
               pv += parseInt($(element).html());
            });
            $('.number').html(pv+'PV');
        })
    </script>
@endsection
