<?php namespace Academy\Course\Components;

use Academy\Course\Models\Course;
use Cms\Classes\ComponentBase;
use Illuminate\Support\Facades\Input;

class Homework extends ComponentBase
{
    public function componentDetails()
    {
        return [
            'name'        => 'homework Component',
            'description' => 'No description provided yet...'
        ];
    }

    public function defineProperties()
    {
        return [];
    }

    public function onSubmit(){
        $getID = Input::get('id');
        $course = Course::find($getID); #Select course with ID
        $fileFromPost = Input::file('file'); #Load uploaded file
        $course->homeWorks()->create(['data' => $fileFromPost ]); #Save it and write into DB
    }
}
