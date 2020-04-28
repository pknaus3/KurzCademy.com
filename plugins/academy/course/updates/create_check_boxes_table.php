<?php namespace Academy\Course\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class CreateCheckBoxesTable extends Migration
{
    public function up()
    {
        Schema::create('academy_course_check_boxes', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->timestamps();
            $table->boolean('is_checked');
            $table->integer('user_id');
            $table->integer('step_id');
        });
    }

    public function down()
    {
        Schema::dropIfExists('academy_course_check_boxes');
    }
}
