<?php namespace Aslkjd\Learningplugin\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateAslkjdLearningpluginLearning extends Migration
{
    public function up()
    {
        Schema::table('aslkjd_learningplugin_learning', function($table)
        {
            $table->boolean('true_false')->default(false);
        });
    }
    
    public function down()
    {
        Schema::table('aslkjd_learningplugin_learning', function($table)
        {
            $table->dropColumn('true_false');
        });
    }
}
