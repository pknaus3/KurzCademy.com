<?php namespace Aslkjd\Learningplugin\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateAslkjdLearningpluginLearning extends Migration
{
    public function up()
    {
        Schema::create('aslkjd_learningplugin_learning', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('aslkjd_learningplugin_learning');
    }
}
