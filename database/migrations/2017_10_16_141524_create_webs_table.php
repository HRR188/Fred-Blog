<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWebsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('webs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->default('FredBlog');
            $table->string('keywords')->default('开源博客，富漾老浩');
            $table->string('description',1000)->default('无聊撸代码，越撸越寂寞');
            $table->string('qrcode')->default('/assets/img/fredcode.png');
            $table->string('logo')->default('/assets/img/fred.png');
            $table->string('beian')->default('©2016-2018 陕icp备16010117号');
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
        Schema::dropIfExists('webs');
    }
}
