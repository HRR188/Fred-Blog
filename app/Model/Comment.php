<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Comment extends Model
{
    protected $guarded = [];
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    //定义评论与文章的反向关联
    public function post()
    {
        return $this->belongsTo('App\Model\Post','post_id','id');
    }
}
