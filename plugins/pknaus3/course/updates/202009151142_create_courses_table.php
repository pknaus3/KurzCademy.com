<?php namespace Pknaus3\Course\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class CreateCoursesTable extends Migration
{
    public function up()
    {
        Schema::create('pknaus3_course_courses', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id')->index();
            $table->string('name')->index();
            $table->string('difficulty')->nullable();
            $table->string('description')->nullable();
            $table->string('tags')->nullable();
            $table->string('coursecolor')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pknaus3_course_courses');
    }
}
