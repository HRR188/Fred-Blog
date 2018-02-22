<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;
class Post extends Model
{
    use Searchable;
    public function searchableAs()
    {
        return 'posts_index';
    }

    //定义搜素字段
    public function toSearchableArray()
    {
        $array = [
            'title'=>$this->title,
            'content'=>$this->content,
        ];
        return $array;
    }

    //文章使用然删除，避免哪天抽风还想怀个旧~
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    //定义文章与分类的多对1反关联关系
    public function category()
    {
        return $this->belongsTo('App\Model\Category', 'cate_id', 'id');
    }

    //定义文章与标签的多对多关联
    public function tags()
    {
        return $this->belongsToMany('App\Model\Tag', 'post_tags', 'post_id', 'tag_id')->withPivot('post_id', 'tag_id');
    }

    //定义文章与评论的1对多关联
    public function comments()
    {
        return $this->hasMany('App\Model\Comment','post_id','id');
    }

}
