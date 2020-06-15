<?php namespace Academy\Course\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class CreateVideosTable extends Migration
{
    public function up()
    {
        Schema::create('academy_course_videos', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->timestamps();
            $table->string("link");
            $table->integer('step_id')->index();
            $table->integer('user_id')->index();
        });
    }

    public function down()
    {
        Schema::dropIfExists('academy_course_videos');
    }
}
