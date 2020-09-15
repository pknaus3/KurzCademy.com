<?php namespace Pknaus3\Topic\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class CreateTopicsTable extends Migration
{
    public function up()
    {
        Schema::create('pknaus3_topic_topics', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id')->index();
            $table->integer('course_id')->index();
            $table->string('name')->index();
            $table->string('why')->nullable();
            $table->string('video_link')->nullable();
            $table->string('docs_link')->nullable();
            $table->string('custom_text')->nullable();
            $table->integer('step_position');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pknaus3_topic_topics');
    }
}
