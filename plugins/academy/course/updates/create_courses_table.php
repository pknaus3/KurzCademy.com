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
            $table->increments('id')->index();
            $table->timestamps();
            $table->string('name')->index();
            $table->integer('author_id')->index();
            $table->string('difficulty')->nullable();
            $table->string('description')->nullable();
            $table->string('tags')->nullable();
            $table->string('coursecolor')->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('academy_course_courses');
    }
}
