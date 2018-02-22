<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    //定义标签与文章的多对多关联
    public function posts()
    {
        $this->belongsToMany('App\Model\Post', 'post_tags', 'tag_id', 'post_id')->withPivot('tag_id', 'post_id');
    }
}
