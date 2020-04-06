<?php namespace AcademyMod\Course\Models;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class CourseUsersPivot extends Migration
{
    public function up()
    {
        Schema::create('course_users_pivot', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->timestamps();
            $table->integer('course_id')->unsigned()->index();
            $table->foreign('course_id')->references('id')->on('academymod_courses')->onDelete('cascade');
            $table->integer('user_id')->unsigned()->index();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('course_users_pivot');
    }
}

