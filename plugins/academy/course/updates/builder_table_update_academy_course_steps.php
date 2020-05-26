<?php namespace Academy\Course\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateAcademyCourseSteps extends Migration
{
    public function up()
    {
        Schema::table('academy_course_steps', function($table)
        {
            $table->bigInteger('course_id')->nullable(false)->unsigned()->default(null)->change();
            $table->integer('step_position')->unsigned()->change();
            $table->index(['id','course_id']);
        });
    }
    
    public function down()
    {
        Schema::table('academy_course_steps', function($table)
        {
            $table->integer('course_id')->nullable(false)->unsigned(false)->default(null)->change();
            $table->integer('step_position')->unsigned(false)->change();
        });
    }
}
