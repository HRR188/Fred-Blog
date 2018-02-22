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
    Route::get('/login','\App\Http\Controllers\Admin\EntryController@loginForm');
    Route::post('/login','\App\Http\Controllers\Admin\EntryController@login');
    Route::get('/home','\App\Http\Controllers\Admin\EntryController@home');
    Route::get('/logout','\App\Http\Controllers\Admin\EntryController@logout');
    //修改个人信息
    Route::get('/change_info','\App\Http\Controllers\Admin\ChangeController@changeForm');
    Route::post('/change_info','\App\Http\Controllers\Admin\ChangeController@changeInfo');
    Route::any('/avatar_upload','\App\Http\Controllers\Admin\ChangeController@avatar');
    //修改个人密码
    Route::get('/change_pass','\App\Http\Controllers\Admin\ChangeController@changePassForm');
    Route::post('/change_pass','\App\Http\Controllers\Admin\ChangeController@changePass');
    //文章资源路由
    Route::resource('/post','\App\Http\Controllers\Admin\PostController');
    //批量删除文章
    Route::post('/posts_delete','\App\Http\Controllers\Admin\PostController@postsDelete');
    //文章封面上传
    Route::any('/pImage_upload','\App\Http\Controllers\Admin\PostController@pImage');
    //要分类文章的数据
    Route::post('/this_cate/{id}','\App\Http\Controllers\Admin\CategoryController@showAllPosts');
    //分类资源路由
    Route::resource('/cate','\App\Http\Controllers\Admin\CategoryController');
    //标签资源路由
    Route::resource('/tag','\App\Http\Controllers\Admin\TagController');
    //回收站路由(表单，单独恢复，批量恢复)
    Route::get('/recover_posts','\App\Http\Controllers\Admin\PostController@recoverPostsForm');
    Route::post('/recover_post/{id}','\App\Http\Controllers\Admin\PostController@recoverPost');
    Route::post('/recover_posts','\App\Http\Controllers\Admin\PostController@recoverPosts');
    //网站管理
    Route::get('/config_web','\App\Http\Controllers\Admin\WebConfigController@showWebConfig');
    Route::post('/config_web','\App\Http\Controllers\Admin\WebConfigController@webConfig');
    Route::any('/logo_upload','\App\Http\Controllers\Admin\WebConfigController@logo');
    //友情链接路由
    Route::resource('/links','\App\Http\Controllers\Admin\LinksController');
    Route::any('/linklogo_upload','\App\Http\Controllers\Admin\LinksController@linklogo');
    //后台评论列表
    Route::get('/comments','\App\Http\Controllers\Admin\CommentController@comments');
    //更新read状态
    Route::post('/comment_read/{id}','\App\Http\Controllers\Admin\CommentController@read');
    //回复评论
    Route::post('/comment_send_message/{id}','\App\Http\Controllers\Admin\Admin\CommentController@sendMessage');
    //删除评论
    Route::post('/comment_delete/{id}','\App\Http\Controllers\Admin\Admin\CommentController@deleteComment');

});

/**
 * 前台
 */
//显示网站主页
Route::get('/','\App\Http\Controllers\User\IndexController@index');
//显示文章详情
Route::get('/post/{id}','\App\Http\Controllers\User\IndexController@showPost');
//前台新回复评论
Route::post('/send_new/{pid}','\App\Http\Controllers\Admin\CommentController@sendNew');
//前台回复楼中楼评论
Route::post('/send_back/{pid}/{cid}','\App\Http\Controllers\Admin\CommentController@sendBack');
//文章搜索
Route::post('/search_post','\App\Http\Controllers\Admin\PostController@postSearch');
//按照分类显示
Route::get('/cate_post/{id}','\App\Http\Controllers\Admin\PostController@catePost');


