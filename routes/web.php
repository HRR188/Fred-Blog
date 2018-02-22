<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/**
 * 后台
 */
Route::group(['prefix'=>'admin'],function(){
    //后台登陆相关
    Route::get('/login','Admin\EntryController@loginForm');
    Route::post('/login','Admin\EntryController@login');
    Route::group(['middleware'=>'admin.auth'],function(){
        Route::get('/home','Admin\EntryController@home');
        Route::get('/logout','Admin\EntryController@logout');
        //修改个人信息
        Route::get('/change_info','Admin\ChangeController@changeForm');
        Route::post('/change_info','Admin\ChangeController@changeInfo');
        Route::any('/avatar_upload','Admin\ChangeController@avatar');
        //修改个人密码
        Route::get('/change_pass','Admin\ChangeController@changePassForm');
        Route::post('/change_pass','Admin\ChangeController@changePass');
        //文章资源路由
        Route::resource('/post','Admin\PostController');
        //批量删除文章
        Route::post('/posts_delete','Admin\PostController@postsDelete');
        //文章封面上传
        Route::any('/pImage_upload','Admin\PostController@pImage');
        //要分类文章的数据
        Route::post('/this_cate/{id}','Admin\CategoryController@showAllPosts');
        //分类资源路由
        Route::resource('/cate','Admin\CategoryController');
        //标签资源路由
        Route::resource('/tag','Admin\TagController');
        //回收站路由(表单，单独恢复，批量恢复)
        Route::get('/recover_posts','Admin\PostController@recoverPostsForm');
        Route::post('/recover_post/{id}','Admin\PostController@recoverPost');
        Route::post('/recover_posts','Admin\PostController@recoverPosts');
        //网站管理
        Route::get('/config_web','Admin\WebConfigController@showWebConfig');
        Route::post('/config_web','Admin\WebConfigController@webConfig');
        Route::any('/logo_upload','Admin\WebConfigController@logo');
        //友情链接路由
        Route::resource('/links','Admin\LinksController');
        Route::any('/linklogo_upload','Admin\LinksController@linklogo');
        //后台评论列表
        Route::get('/comments','Admin\CommentController@comments');
        //更新read状态
        Route::post('/comment_read','Admin\CommentController@read');
        //回复评论
        Route::post('/comment_send_message/{id}','Admin\CommentController@sendMessage');
        //删除评论
        Route::post('/comment_delete/{id}','Admin\CommentController@deleteComment');
        //专栏资源路由
        Route::resource('/column','Admin\ColumnController');
        //要分类专题的数据
        Route::post('/this_column/{id}','Admin\ColumnController@showAllPosts');
    });

});

/**
 * 前台
 */
//显示网站主页
Route::get('/','User\IndexController@index');
//显示文章详情
Route::get('/post/{id}','User\IndexController@showPost');
//前台新回复评论
Route::post('/send_new/{pid}','Admin\CommentController@sendNew');
//前台回复楼中楼评论
Route::post('/send_back/{pid}/{cid}','Admin\CommentController@sendBack');
//文章搜索
Route::post('/search_post','Admin\PostController@postSearch');
//按照分类显示
Route::get('/cate_post/{id}','Admin\PostController@catePost');
//专栏
Route::post('/column','User\IndexController@showColumnPosts');

