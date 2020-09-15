<?php namespace Pknaus3\User\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class CreateCheckboxesTable extends Migration
{
    public function up()
    {
        Schema::create('pknaus3_user_checkboxes', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->unsignedBigInteger('user_id')->index();
            $table->unsignedBigInteger('topic_id')->index();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pknaus3_user_checkboxes');
    }
}
