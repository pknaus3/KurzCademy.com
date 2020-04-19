<?php namespace Academy\Course\Updates;

use October\Rain\Database\Updates\Seeder;
use Academy\Course\Models\Course;

class SeedAllTables extends Seeder{
    public function run(){
        $seed = new Course();
        $seed->name = 'FrontEnd';
        $seed->publisher = 1;
        $seed->difficulty = 'medium';
        $seed->description = "Javascript";
        $seed->teacher = 1;
        $seed->save();
    }
}
