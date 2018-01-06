<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DetailCreate extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('chapter_id')->unsigned()->comment('卷ID');
            $table->foreign('chapter_id')->references('id')->on('chapter')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->smallInteger('chapter_num')->comment('数字章')->index()->nullable();
            $table->smallInteger('section_num')->comment('数字节')->index()->nullable();
            $table->string('version')->nullable();

            $table->longtext('content')->comment('详情 分节 非圣经译本直接显示全部内容')->nullable();

            $table->longtext('detail_origin_text')->comment('详情解析前的内容 即包含所有的标签及样式的内容')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detail');
    }
}
