<?php

use October\Rain\Auth\Models\User;
use Academy\Course\Models\Course;
use Academy\Course\Models\Step;


Route::post('/check', function ($req) {
    $data = $req->input();

    $check = new CheckBox();
    $check->user = User::getAuth()->id;
    $check->step_id = $data['step_id'];
    $check->is_checked = $data['is_checked'];
    $check->save();
});

Route::get('api/courses', function () {
    $courses = Course::All();
    foreach ($courses as $key => $course) {
        $course->thumbPath = $course->courseThumb->getPath();
    }
    return $courses;
});

Route::get('api/course/{id}', function ($courseId) {
    $course = Course::where('id',$courseId)->firstOrFail();
    return $course;
});

Route::get('api/steps/{id}', function ($courseId) {
    $steps = Step::where('course_id',$courseId)->get();
    return $steps;
});

Route::get('api/step/{id}', function ($stepId) {
    $step = Step::where('id',$stepId)->firstOrFail();
    if ($step->docs_link) {
        $step->renderedDocsHtml = Http::get($step->docs_link)->body;
    }
    return $step;
});

