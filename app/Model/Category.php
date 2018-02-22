<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Category extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $guarded = [];

    //定义分类与文章的1对多关系
    public function posts()
    {
       return  $this->hasMany('App\Model\Post','cate_id','id');
    }
}
