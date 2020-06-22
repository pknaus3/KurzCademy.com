<?php

use Academy\Course\Models\Course;
use Academy\Course\Models\Step;
use Academy\Course\Models\CheckBox;
use Academy\Course\Models\Comments;
use Academy\Course\Models\FavoriteCourses;

use Academy\Course\Models\Video;
use RainLab\User\Facades\Auth;
use RainLab\User\Models\User;

use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;


Route::get('api/courses/{max}', function ($max) {
    if ($max == -1) {
        $courses = Course::All();
    } else {
        $courses = Course::take($max)->get();
    }

    foreach ($courses as $course) {
        if (isset($course->courseThumb)) {
            $course->thumbPath = $course->courseThumb->getPath();
        }
    }
    return $courses;
});

Route::get('api/course/{id}', function ($courseId) {
    $course = Course::where('id', $courseId)->firstOrFail();
    return $course;
});

Route::get('api/steps/{id}', function ($courseId) {
    $steps = Step::where('course_id', $courseId)->get();
    return $steps;
});

Route::get('api/step/{id}', function ($stepId) {
    $step = Step::where('id', $stepId)->firstOrFail();
    if ($step->docs_link) {
        $step->renderedDocsHtml = Http::get($step->docs_link)->body;
    }
    return $step;
});
