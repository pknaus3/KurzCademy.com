<?php namespace Academy\Course\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateAcademyCourseCourses extends Migration
{
    public function up()
    {
        Schema::table('academy_course_courses', function($table)
        {
            $table->string('keywords')->nullable();
            $table->string('difficulty')->nullable()->change();
            $table->string('description')->nullable()->change();
            $table->integer('teacher_id')->nullable()->change();
        });
    }
    
    public function down()
    {
        Schema::table('academy_course_courses', function($table)
        {
            $table->dropColumn('keywords');
            $table->string('difficulty')->nullable(false)->change();
            $table->string('description')->nullable(false)->change();
            $table->integer('teacher_id')->nullable(false)->change();
        });
    }
}
