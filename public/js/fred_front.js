//监听元素大小改变
(function($, h, c) {
    var a = $([]), e = $.resize = $.extend($.resize, {}), i, k = "setTimeout", j = "resize", d = j
        + "-special-event", b = "delay", f = "throttleWindow";
    e[b] = 350;
    e[f] = true;
    $.event.special[j] = {
        setup : function() {
            if (!e[f] && this[k]) {
                return false
            }
            var l = $(this);
            a = a.add(l);
            $.data(this, d, {
                w : l.width(),
                h : l.height()
            });
            if (a.length === 1) {
                g()
            }
        },
        teardown : function() {
            if (!e[f] && this[k]) {
                return false
            }
            var l = $(this);
            a = a.not(l);
            l.removeData(d);
            if (!a.length) {
                clearTimeout(i)
            }
        },
        add : function(l) {
            if (!e[f] && this[k]) {
                return false
            }
            var n;
            function m(s, o, p) {
                var q = $(this), r = $.data(this, d);
                r.w = o !== c ? o : q.width();
                r.h = p !== c ? p : q.height();
                n.apply(this, arguments)
            }
            if ($.isFunction(l)) {
                n = l;
                return m
            } else {
                n = l.handler;
                l.handler = m
            }
        }
    };
    function g() {
        i = h[k](function() {
            a.each(function() {
                var n = $(this), m = n.width(), l = n.height(), o = $
                    .data(this, d);
                if (m !== o.w || l !== o.h) {
                    n.trigger(j, [ o.w = m, o.h = l ])
                }
            });
            g()
        }, e[b])
    }
})(jQuery, this);
//实时改变canvas容器大小
$(function(){
    $('#nav').resize(function(){
        $('#canvas').height($(this).height());
        if($('#canvas').height()<100){
            $('#canvas').height(100)
        }

    })
});
//显示回到顶部按钮
$(function(){
    $('#back-top').css({'display':'none'});
    $(window).scroll(function(){
        let pageHeight = document.documentElement.clientHeight;
        let backTop =  document.documentElement.scrollTop;
        if(backTop > pageHeight){
            $('#back-top').css({'display':''});
        }else{
            $('#back-top').css({'display':'none'});
        }
    })
});
//文章搜索
$(function(){
    $('#search').click(function(event){
        let progress = $.AMUI.progress;
        progress.start();
        let post = $('input[name=search]').val();
        if(post){
            $.ajax({
                url:'/search_post',
                method: 'POST',
                dataType: 'json',
                data:{
                    'post':post
                },
                success(response){
                    progress.done();
                    $('#index').children().hide();
                    let count = response.searchPosts.length;
                    if(count>0){
                        $('#index').append(' <h3>找到相关文章: '+count+'篇</h3>');
                        response.searchPosts.forEach(function(val,index){
                            $('#index').append(' <article class="am-g blog-entry-article">'+
                                '<div class="am-u-lg-3 am-u-md-12 am-u-sm-12 blog-entry-img">'+
                                '<img class="blog-entry-img" alt=/post/'+val.id+' src='+val.p_image+'>'+
                                '</div>'+
                                '<div class="am-u-lg-9 am-u-md-12 am-u-sm-12 blog-entry-text">'+
                                '<span>'+val.created_at+'</span>'+
                                '<h1><a href=/post/'+val.id+'>'+val.title+'&nbsp;</a></h1>'+
                                '<p>'+val.intro+'</p>'+
                                '</div>'+
                                '</article>')
                        });
                    }else{
                        $('#index').append(' <h3>没有找到相关文章，换个词试试~</h3>'+
                            '<img src="/img/no-post.jpg" id="no-post">');
                        $('input[name=search]').val('');
                        setTimeout(function(){
                            $('#index').children().show();
                            $('#index').find('h3').remove();
                            $('#no-post').remove();
                        },3000)
                    }

                }
            })
        }else{
            $('input[name=search]').attr('placeholder','请输入文字！');
            return false;
        }

    });

});

//成功的Modal
$(function(){
    $('#my-success').modal();
    setTimeout(function(){
        $('#my-success').modal('close');
    },2000)
})
//
// function catePost(id){
//     $.ajax({
//         url: '/cate_post/'+id,
//         dataType: 'json',
//         method: 'POST',
//         success(response){
//             console.log(response.posts);
//         }
//     })
// }

$(function(){
    $('#weixin').on('open.popover.amui',function(){
        $('#intro').children('h2').children().html('微信');
        $('#intro').children('img').eq(0).hide();
        $('#intro').children('img').eq(1).show();
    });
    $('#weixin').on('close.popover.amui',function(){
        $('#intro').children('h2').children().html('博客介绍');
        $('#intro').children('img').eq(1).hide();
        $('#intro').children('img').eq(0).show();
    })
});