<?php namespace Academy\Course\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateAcademyCourseCourses2 extends Migration
{
    public function up()
    {
        Schema::table('academy_course_courses', function($table)
        {
            $table->string('coursecolor')->nullable();
        });
    }
    
    public function down()
    {
        Schema::table('academy_course_courses', function($table)
        {
            $table->dropColumn('coursecolor');
        });
    }
}
