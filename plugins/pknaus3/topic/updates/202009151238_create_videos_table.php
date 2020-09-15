<?php namespace Pknaus3\Topic\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class CreateVideosTable extends Migration
{
    public function up()
    {
        Schema::create('pknaus3_topic_videos', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->unsignedBigInteger('topic_id')->index();
            $table->string('video_link');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pknaus3_topic_videos');
    }
}
