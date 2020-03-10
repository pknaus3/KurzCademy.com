<?php namespace Academy\Course\Components;

use Cms\Classes\ComponentBase;
use Model;
use Academy\Course\Models\Course;
use Db;


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
    }

    public function defineProperties()
    {
        return [];
    }
}
