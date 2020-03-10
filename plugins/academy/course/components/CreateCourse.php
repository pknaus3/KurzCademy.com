<?php namespace Academy\Course\Components;

use Cms\Classes\ComponentBase;
use Model;
use Academy\Course\Models\Course;
use Db;
use Schema;


class CreateCourse extends ComponentBase
{
    public function componentDetails()
    {
        return [
            'name'        => 'Create Course',
            'description' => 'Add this to page to create form for new course'
        ];
    }


    public function onSaveCourse(){
        $data = request()->only([
          'name',
          'publisher',
          'difficulty',
          'description',
          'teacher_name'
        ]);
        Course::create($data);
        Schema::create('academy_course_' . $data['name'],function($Ctable){
          $Ctable->engine = 'InnoDB';
          $Ctable->increments('id');
          $Ctable->string('step_name');
          $Ctable->string('type');
          $Ctable->string('position');
          $Ctable->string('link');
        });
    }


    public function defineProperties()
    {
        return [];
    }
}
