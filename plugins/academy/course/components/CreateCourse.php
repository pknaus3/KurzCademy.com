<?php namespace Academy\Course\Components;

use Cms\Classes\ComponentBase;

class CreateCourse extends ComponentBase
{
    public function componentDetails()
    {
        return [
            'name'        => 'Create Course',
            'description' => 'Add this to page to create form for new course'
        ];
    }


    protected function saveCourse(){
        $name = input::get('name');
        $description = input::get('description');
        $publisher = input::get('publisher');
        $teacherName = input::get('teacherName');
        $difficulty = input::get('difficulty');

        if (input::get('name')==1) {
          Db::insert('insert into academy_course_courses (name, publisher, difficulty, description) values ($name, $publisher, $difficulty, $description )');
        }
        else {
          echo "Kontaktujte administrátora web stránky";
        }


    }

    public function defineProperties()
    {
        return [];
    }
}
