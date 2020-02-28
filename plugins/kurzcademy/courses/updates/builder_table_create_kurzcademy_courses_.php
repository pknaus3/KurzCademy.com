<?php namespace Kurzcademy\Courses\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateKurzcademyCourses extends Migration
{
    public function up()
    {
        Schema::create('kurzcademy_courses_', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->text('name');
            $table->text('description');
            $table->text('author');
            $table->text('difficulty');
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('kurzcademy_courses_');
    }
}
