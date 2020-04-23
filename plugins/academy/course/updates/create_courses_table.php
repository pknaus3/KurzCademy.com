<?php namespace Academy\Course\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class CreateCoursesTable extends Migration
{
    public function up()
    {
        Schema::create('academy_course_courses', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->timestamps();
            $table->string('name');
            $table->integer('publisher_id');
            $table->string('difficulty');
            $table->string('description');
            $table->integer('teacher_id');
        });
    }

    public function down()
    {
        Schema::dropIfExists('academy_course_courses');
    }
}
