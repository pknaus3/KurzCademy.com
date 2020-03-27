<?php namespace AcademyMod\CreateCourse\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class CreateCreateCoursesTable extends Migration
{
    public function up()
    {
        Schema::create('academymod_createcourse_create_courses', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->timestamps();
            $table->string('name');
            $table->string('publisher');
            $table->string('difficulty');
            $table->string('description');
            $table->string('teacher_name');
        });
    }

    public function down()
    {
        Schema::dropIfExists('academymod_createcourse_create_courses');
    }
}
