<?php namespace Academymod\Course\Components;

use Cms\Classes\ComponentBase;

class Course extends ComponentBase
{
    public function componentDetails()
    {
        return [
            'name'        => 'course Component',
            'description' => 'No description provided yet...'
        ];
    }

    public function defineProperties()
    {
        return [];
    }
}
