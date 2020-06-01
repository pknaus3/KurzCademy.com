<?php

use Academy\Course\Models\Comments;
use Academy\Course\Models\FavoriteCourses;
use Illuminate\Http\Request;
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

Route::post('/api/comment', function (Request $req){
    $data = $req->input();

    $comment = new Comments();
    $comment->comment = $data['comment'];
    $comment->course_id = $data['course_id'];
    $comment->user_id = $data['user_id'];
    $comment->save();
});

Route::get('api/comments/{id}', function ($courseId) {
    $comments = Comments::where('course_id', $courseId)->get();
    return $comments;
});

Route::post('/api/addFavorite', function (Request $req){
    $data = $req->input();

    $favCourse = new FavoriteCourses();
    $favCourse->course_id = $data['course_id'];
    $favCourse->user_id = $data['user_id'];
    $favCourse->save();
});

Route::get('api/favoritesCourses/{id}', function ($userId) {
    $favCourses = FavoriteCourses::where('user_id', $userId)->get();
    return $favCourses;
});
