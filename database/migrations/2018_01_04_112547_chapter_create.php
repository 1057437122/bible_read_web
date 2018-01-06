<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChapterCreate extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chapter', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('volume_id')->unsigned()->comment('卷ID');
            $table->foreign('volume_id')->references('id')->on('volume')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->integer('list_id')->unsigned()->comment('编ID')->nullable();
            $table->foreign('list_id')->references('id')->on('list')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->string('name')->comment('章 或者 目录');
            $table->string('href')->comment('临时用 解析完了就作废了')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('chapter');
    }
}
