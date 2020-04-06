<?php namespace Academymod\Createcourse\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class CreateStepssTable extends Migration
{
    public function up()
    {
        Schema::create('academymod_steps', function (Blueprint $table) {
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

            $table->foreign('course_id')->references('id')->on('academymod_courses');
        });
    }

    public function down()
    {
        Schema::dropIfExists('academymod_steps');
    }
}
