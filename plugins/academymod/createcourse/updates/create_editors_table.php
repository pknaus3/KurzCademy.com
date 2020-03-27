<?php namespace Academymod\Createcourse\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class CreateEditorsTable extends Migration
{
    public function up()
    {
        Schema::create('academymod_createcourse_editors', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->timestamps();
            $table->string('course_name');
            $table->string('video_link');
            $table->string('docs_link');
            $table->string('custom_text');
            $table->integer('step_position');
            $table->foreign('course_name')->references('name')->on('academymod_createcourse_create_courses');
        });
    }

    public function down()
    {
        Schema::dropIfExists('academymod_createcourse_editors');
    }
}
