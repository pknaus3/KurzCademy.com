<?php namespace Academy\Course\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateAcademyCourseComments extends Migration
{
    public function up()
    {
        Schema::table('academy_course_comments', function($table)
        {
            $table->renameColumn('course_id', 'step_id');
        });
    }
    
    public function down()
    {
        Schema::table('academy_course_comments', function($table)
        {
            $table->renameColumn('step_id', 'course_id');
        });
    }
}
