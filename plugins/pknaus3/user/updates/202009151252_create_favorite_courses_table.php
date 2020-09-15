<?php namespace Pknaus3\User\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class CreateFavoriteCoursesTable extends Migration
{
    public function up()
    {
        Schema::create('pknaus3_user_favorite_courses', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->unsignedBigInteger('user_id')->index();
            $table->unsignedBigInteger('course_id')->index();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pknaus3_user_favorite_courses');
    }
}
