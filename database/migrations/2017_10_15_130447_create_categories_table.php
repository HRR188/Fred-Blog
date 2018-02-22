<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //本来想和以前的博客一样搞无限分类，但是又觉得没那个必要。。。drop了pid
        Schema::create('categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('cname');
            $table->integer('post_id');
            $table->integer('pid');
            $table->integer('cid');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories');
    }
}
