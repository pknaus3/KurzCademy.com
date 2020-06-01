<?php namespace Academy\Course\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class CreateFavoriteCoursesTable extends Migration
{
    public function up()
    {
        Schema::create('academy_course_favorite_courses', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->timestamps();
            $table->integer('course_id')->index();
            $table->integer('user_id')->index();
        });
    }

    public function down()
    {
        Schema::dropIfExists('academy_course_favorite_courses');
    }
}
