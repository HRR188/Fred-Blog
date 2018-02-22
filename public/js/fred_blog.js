//设置ajax默认token
$(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
});
//时间脚本
function myTime() {
    let divTime = document.getElementById('time');
    let now = new Date();
    let localTime = now.toLocaleString();
    divTime.innerHTML = localTime;
}
function start() {
    window.setInterval("myTime()", 1000);
}
$(document).ready(function () {
    $('#flash-overlay-modal').modal('show');
    setTimeout(function () {
        $('#flash-overlay-modal').modal('hide');
    }, 1000)
});
//查看comment，并且将为查看的消息发异步，将read设为1
function showComment(id,title, time,nickname,content) {
    $('.am-dropdown').dropdown('close');
    $('#my-popup').on('open.modal.amui', function () {
        $(this).find('h4').html('对文章'+title+'的评论');
        $(this).find('p').children().empty();
        $(this).find('p').append(
            '<li><article class="am-comment">'+
            '<div class="am-comment-main">'+
            '<header class="am-comment-hd">'+
            '<div class="am-comment-meta">'+
            '<a href="#link-to-user" class="am-comment-author">'+nickname+'</a>'+
            '评论于 <time datetime="">'+time+'</time>'+
            '</div>'+
            '</header>'+
            '<div class="am-comment-bd">'+content+'</div>'+
            '</div>'+
            '</article></li>');
    });
    $('#my-popup').on('closed.modal.amui',function(){
        $.ajax({
            url: '/admin/comment_read/'+id,
            dataType: 'json',
            method: 'POST',
            success(response){
                if(response.code === 200){
                    window.location.reload()
                }
            }
        })
    });
}



