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
    return $courses;
});
Route::get('api/steps', function () {
    $steps = Step::All();
    return $steps;
});

