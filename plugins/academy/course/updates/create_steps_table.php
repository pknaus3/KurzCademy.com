<?php namespace Academy\Course\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class CreateStepsTable extends Migration
{
    public function up()
    {
        Schema::create('academy_course_steps', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->timestamps();
            $table->integer('course_id');
            $table->string('step_name');
            $table->string('video_link');
            $table->string('docs_link');
            $table->string('custom_text');
            $table->integer('step_position');
            $table->boolean('homework')->default('false');
        });
    }

    public function down()
    {
        Schema::dropIfExists('academy_course_steps');
    }
}
