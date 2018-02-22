<?php

namespace App\Providers;

use App\Model\Category;
use App\Model\Column;
use App\Model\Tag;
use App\Model\Web;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use App\Model\Post;
use App\Model\Link;
use App\Model\Comment;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        //服务点亮时就算出当前的文章数，分类数，标签数，软删除的文章数等。。。。
        $pCount = Post::all()->count();
        \View::composer('layout.list',function($view) use ($pCount){
            $view->with('pCount',$pCount);
        });
        $cCount = Category::whereNull('pid')->count();
        \View::composer('layout.list',function($view) use ($cCount){
            $view->with('cCount',$cCount);
        });
        $tCount = Tag::all()->count();
        \View::composer('layout.list',function($view) use ($tCount){
            $view->with('tCount',$tCount);
        });
        $rCount = Post::onlyTrashed()->count();
        \View::composer('layout.list',function($view) use ($rCount){
            $view->with('rCount',$rCount);
        });
        $lCount = Link::all()->count();
        \View::composer('layout.list',function($view) use ($lCount){
            $view->with('lCount',$lCount);
        });
        $coCount = Comment::whereNull('comment_id')->where('read',0)->count();
        \View::composer('layout.list',function($view) use ($coCount){
            $view->with('coCount',$coCount);
        });
        $columnCount = Column::all()->count();
        \View::composer('layout.list',function($view) use ($columnCount){
            $view->with('columnCount',$columnCount);
        });

        $newComments = Comment::whereNull('comment_id')->where('read',0)->orderBy('created_at','desc')->get();
        \View::composer('layout.nav',function($view) use ($newComments){
            $view->with('newComments',$newComments);
        });

        //前台head
        $webConfig = Web::where('id',1)->first();
        \View::composer('user.head',function($view) use ($webConfig){
            $view->with('webConfig',$webConfig);
        });
        //侧边栏介绍
        \View::composer('user.sidebar',function($view) use ($webConfig){
            $view->with('webConfig',$webConfig);
        });
        //侧边栏tag
        $tags = Tag::all();
        \View::composer('user.sidebar',function($view) use ($tags){
            $view->with('tags', $tags);
        });
        //专题
        $columns = Column::all();
        \View::composer('user.sidebar',function($view) use ( $columns){
            $view->with('columns', $columns);
        });

        //侧边栏cate
        $cates = Category::whereNull('pid')->orderBy('id','desc')->get();
        \View::composer('user.nav',function($view) use ($cates){
            $view->with('cates', $cates);
        });
        \View::composer('user.sidebar',function($view) use ($cates){
            $view->with('cates', $cates);
        });

        //底部备案
        \View::composer('user.footer',function($view) use ($webConfig){
            $view->with('webConfig',$webConfig);
        });

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
