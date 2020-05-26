<?php namespace Academy\Course\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateAcademyCourseCourses3 extends Migration
{
    public function up()
    {
        Schema::table('academy_course_courses', function($table)
        {
            $table->bigInteger('publisher_id')->nullable(false)->unsigned()->default(null)->change();
            $table->bigInteger('teacher_id')->nullable()->unsigned()->default(null)->change();
            $table->index(['id','publisher_id','teacher_id']);
        });
    }
    
    public function down()
    {
        Schema::table('academy_course_courses', function($table)
        {
            $table->integer('publisher_id')->nullable(false)->unsigned(false)->default(null)->change();
            $table->integer('teacher_id')->nullable()->unsigned(false)->default(null)->change();
        });
    }
}
