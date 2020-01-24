<?php namespace PeterKnaus\FileUploader\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreatePeterknausFileuploader extends Migration
{
    public function up()
    {
        Schema::create('peterknaus_fileuploader_', function($table)
        {
            $table->engine = 'InnoDB';
            $table->integer('test');
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('peterknaus_fileuploader_');
    }
}
