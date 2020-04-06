<?php namespace Academymod\Createcourse\Components;

use AcademyMod\CreateCourse\Models\CreateCourse;
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
        $course = Createcourse::find(1);
        $fileFromPost = Input::file('file');
        $course->homeWorks()->create(['data' => $fileFromPost ]);
    }
}
