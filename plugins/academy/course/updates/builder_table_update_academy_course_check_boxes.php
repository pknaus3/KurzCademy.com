<?php namespace Academy\Course\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateAcademyCourseCheckBoxes extends Migration
{
    public function up()
    {
        Schema::table('academy_course_check_boxes', function($table)
        {
            $table->bigInteger('user_id')->nullable(false)->unsigned()->default(null)->change();
            $table->bigInteger('step_id')->nullable(false)->unsigned()->default(null)->change();
            $table->index(['id','user_id','step_id']);
        });
    }
    
    public function down()
    {
        Schema::table('academy_course_check_boxes', function($table)
        {
            $table->integer('user_id')->nullable(false)->unsigned(false)->default(null)->change();
            $table->integer('step_id')->nullable(false)->unsigned(false)->default(null)->change();
        });
    }
}
