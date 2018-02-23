@extends('admin.master')
@section('content')
    {{--这里使用了fileupload，因为我懒就直接在本页面引用了--}}
    {{--需要将jquery.ui放在最前面运行--}}
    <script src="/js/jquery.js"></script>
    <script src="/js/jquery.ui.widget.js"></script>
    <script src="https://cdn.bootcss.com/jqueryui/1.12.0/jquery-ui.js"></script>
    <script src="/js/jquery.fileupload.js"></script>
    <script src="/js/jquery.fileupload-process.js"></script>
    <script src="/js/jquery.fileupload-image.js"></script>
    <script src="/js/jquery.iframe-transport.js"></script>
    <script type="text/javascript" charset="utf-8" src="/js/ueditor.config.js"></script>
    <script type="text/javascript" charset="utf-8" src="/js/ueditor.all.min.js"> </script>
    <script type="text/javascript" charset="utf-8" src="/lang/zh-cn/zh-cn.js"></script>
    {{--为了隐藏上传文件Input的默认文字--}}
    <style>
        input[type="file"] {
            color: transparent;
        }

    </style>

    <div class="tpl-content-wrapper">
        <div class="tpl-content-page-title">
            新增文章
        </div>
        <ol class="am-breadcrumb">
            <li><a href="/admin/home" class="am-icon-home">首页</a></li>
            <li><a href="/admin/post">文章管理</a></li>
            <li class="am-active">新增文章</li>
        </ol>
        <div class="tpl-portlet-components">
            <div class="portlet-title">
                <div class="caption font-green bold">
                    <span class="am-icon-code"></span> 新增文章
                </div>
                <div class="tpl-portlet-input tpl-fz-ml">
                    <div class="portlet-input input-small input-inline">
                        <div class="input-icon right">
                            <i class="am-icon-search"></i>
                            <input type="text" class="form-control form-control-solid" placeholder="搜索..."> </div>
                    </div>
                </div>
            </div>

            <div class="tpl-block">

                <div class="am-g">
                    <div class="tpl-form-body tpl-form-line">
                        <form class="am-form tpl-form-line-form" action="/admin/post" method="POST">
                            {{csrf_field()}}
                            <div class="am-form-group">
                                <label for="user-name" class="am-u-sm-3 am-form-label">标题 <span class="tpl-form-line-small-title">Title</span></label>
                                <div class="am-u-sm-9">
                                    <input type="text" class="tpl-form-input" name="title" placeholder="请输入标题文字" value="{{old('title')}}">
                                    <small>请填写标题文字10-20字左右。</small>
                                </div>
                            </div>
                            <div class="am-form-group">
                                <label for="user-name" class="am-u-sm-3 am-form-label">摘要 <span class="tpl-form-line-small-title">Intro</span></label>
                                <div class="am-u-sm-9">
                                    <input type="text" class="tpl-form-input" name="intro" placeholder="默认文章前100字" value="">
                                    <small>自己修改最好~</small>
                                </div>
                            </div>
                            <div class="am-form-group">
                                <label for="user-weibo" class="am-u-sm-3 am-form-label">封面图 <span class="tpl-form-line-small-title">Images</span></label>
                                <div class="am-u-sm-9">
                                    {{--文章封面图片上传--}}
                                    <div class="form-group">
                                        <div class="col-sm-10">
                                            <div class="input-group">
                                                <label type="button" class="am-btn am-btn-danger am-btn-sm" for="pImage_upload">
                                                    <i class="am-icon-cloud-upload"></i> 选择文件</label>
                                                <div hidden>
                                                    <input id="pImage_upload" type="file" name="pImage" data-url="/admin/pImage_upload" multiple >
                                                </div>
                                                <div id="show"></div>
                                                <input type="hidden" value="{{asset('/assets_admin/img/pimage.png')}}" id="pImage_input" name="pImage_input">
                                                <button id="pImage_submit" class="am-btn am-btn-success am-btn-sm" onclick="return false" hidden>
                                                </button>
                                            </div>
                                            <div class="input-group" style="margin-top:5px;">
                                                <img src="{{asset('/assets_admin/img/pimage.png')}}" class="img-responsive img-thumbnail"  width="200px" id="pImage" >
                                            </div>
                                        </div>

                                        <script>
                                            $.ajaxSetup({
                                                headers: {
                                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                                }
                                            });
                                            $('#pImage_upload').fileupload({
                                                dataType: 'json',
                                                add: function (event, data) {
                                                    data.context = $('#pImage_submit').show().text('点击上传')
                                                        .appendTo('#show')
                                                        .click(function (event) {
                                                            data.context = $('<p/>').text('上传中...').replaceAll($(this));
                                                            data.submit();
                                                        });
                                                },
                                                done: function (e, data) {
                                                    data.context.text('上传完成.');
                                                    setTimeout(function(){
                                                        $('#show').hide('slow');
                                                    })
                                                },
                                                success: function(response){
                                                    $('#pImage').attr('width','200px').attr('src',response.path);
                                                    $('#pImage_upload').attr('src',response.path);
                                                    $('#pImage_input').val(response.path);

                                                }

                                            });
                                        </script>
                                    </div>
                                    {{--文章封面上传结束--}}
                                </div>
                            </div>

                            <div class="am-form-group">
                                <label for="user-weibo" class="am-u-sm-3 am-form-label">添加分类 <span class="tpl-form-line-small-title">Type</span></label>
                                <div class="am-u-sm-9 ">
                                    <div class="am-form-group">
                                        <select data-am-selected="{btnWidth: '30%', btnSize: 'sm', btnStyle: 'secondary' ,maxHeight: 100,searchBox: 1}" name="cate" placeholder="记得选分类">
                                            <option selected value=""></option>
                                            @foreach($cates as $cate)
                                                <option value="{{$cate->id}}" >{{$cate->cname}}</option>
                                            @endforeach
                                        </select>
                                        <input type="hidden" value="" name="selected_cate">
                                    </div>
                                </div>
                            </div>

                            <div class="am-form-group">
                                <label for="user-intro" class="am-u-sm-3 am-form-label">文章专栏 colmun</label>
                                <div class="am-u-sm-9">
                                    <select data-am-selected="{btnWidth: '30%', btnSize: 'sm', btnStyle: 'secondary' ,maxHeight: 100,searchBox: 1}" name="column" placeholder="不选默认为空">
                                        <option selected value=""></option>
                                        @foreach($columns as $column)
                                            <option value="{{$column->id}}" >{{$column->name}}</option>
                                        @endforeach
                                        <input type="hidden" value="0" name="selected_column">
                                    </select>
                                </div>
                            </div>


                            <div class="am-form-group">
                                <label for="user-intro" class="am-u-sm-3 am-form-label">文章标签 tags</label>
                                <div class="am-u-sm-9">
                                  @foreach($tags as $tag)
                                        <label class="am-checkbox-inline">
                                            <input type="checkbox"  name="tag_ids[]" value="{{$tag->id}}" data-am-ucheck> {{$tag->name}}
                                        </label>
                                    @endforeach
                                </div>
                            </div>


                            <div class="am-form-group">
                                <label for="user-intro" class="am-u-sm-3 am-form-label">文章内容 content</label>
                                <div class="am-u-sm-9">
                                    <script id="editor" type="text/plain" class="ueditor" >
                                        {!! old('contents') !!}
                                    </script>
                                    <input type="hidden" value="{{old('contents')}}" name="contents">
                                </div>
                            </div>

                            <div class="am-form-group">
                                <div class="am-u-sm-9 am-u-sm-push-3">
                                    <button type="submit" class="am-btn am-btn-primary tpl-btn-bg-color-success ">提交</button>
                                </div>
                            </div>
                        </form>
                        @include('admin.errors')
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
@section('_js')
    <script type="text/javascript">
        //实例化编辑器
        var ue = UE.getEditor('editor',{initialFrameWidth: null});
        ue.ready(function(){
            ue.execCommand('serverparam', '_token', '{{ csrf_token() }}');
            ue.addListener('blur',function(){
                $('input[name=contents]').val(ue.getContent());
                let text = ue.getPlainTxt();
                text = text.replace(/<img[^>]*>/gi,'');
                $('input[name=intro]').val(text.substring(0,99)+'...')
            })

        });
        $(function () {
            $("[name='cate']").on('change', function() {
                $('input[name=selected_cate]').val($(this).val());
            });
            $("[name='column']").on('change', function() {
                $('input[name=selected_column]').val($(this).val());
            });
        })
    </script>
@endsection()
