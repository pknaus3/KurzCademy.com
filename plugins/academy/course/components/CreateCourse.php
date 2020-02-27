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

    public function defineProperties()
    {
        return [];
    }
}
