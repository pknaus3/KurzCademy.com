<?php namespace Academymod\Course\Components;

use AcademyMod\Course\Models\Course;
use Cms\Classes\ComponentBase;
use Illuminate\Support\Facades\Input;

class HomeWork extends ComponentBase
{
    public function componentDetails()
    {
        return [
            'name'        => 'HomeWork Component',
            'description' => 'No description provided yet...'
        ];
    }

    public function defineProperties()
    {
        return [];
    }
    public function onSubmit(){
        $course = Course::find(1);
        $fileFromPost = Input::file('file');
        $course->homeWorks()->create(['data' => $fileFromPost ]);
    }
}
