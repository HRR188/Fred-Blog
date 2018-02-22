<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Column extends Model
{
    protected $guarded =[];

    //定义与文章的1对多关联
    public function posts()
    {
        return $this->hasMany('App\Model\Post','column_id','id');
    }
}
