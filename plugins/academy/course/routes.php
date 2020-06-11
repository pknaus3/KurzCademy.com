<?php

use Academy\Course\Models\CheckBox;
use Academy\Course\Models\Comments;
use Academy\Course\Models\FavoriteCourses;
use Illuminate\Http\Request;
use October\Rain\Auth\Models\User;
use Academy\Course\Models\Course;
use Academy\Course\Models\Step;
use RainLab\User\Facades\Auth;

Route::post('api/check', function ($req) {
    $data = $req->input();

    $check = new CheckBox();
    $check->user = Auth::getAuth()->id;
    $check->step_id = $data['step_id'];
    $check->is_checked = 1;
    $check->save();
});

Route::delete('api/uncheck/{id}', function ($checkboxID) {
    $checkbox = CheckBox::find($checkboxID);
    $user = Auth::getUser();
    if ($user->id == $checkbox->user_id) {
        $checkbox->delete();
    }
});
Route::get('api/getCheck/{id}', function ($checkboxID) {
    $user = Auth::getUser();
    $checkbox = CheckBox::findOrFail($checkboxID);
    if ($checkbox == 1) {
        if ($user->id == $checkbox->user_id) {
            return 1;
        }
    }
});

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

Route::post('/api/comment', function (Request $req) {
    $data = $req->input();

    $comment = new Comments();
    $comment->comment = $data['comment'];
    $comment->course_id = $data['course_id'];
    $comment->user_id = Auth::getUser()->id;
    $comment->save();
});

Route::get('api/comments/{id}', function ($courseId) {
    $comments = Comments::where('course_id', $courseId)->get();
    foreach ($comments as $key => $comment) {
        $user = User::find($comment->user_id);
        $user = Auth::findUserByLogin($user->email);
        if (isset($user->avatar)) {
            $user->avatarPath = $user->avatar->getPath();
        }
        $comment->user = $user;
    }
    return $comments;
});

Route::post('/api/addFavorite', function (Request $req) {
    $data = $req->input();

    $favCourse = new FavoriteCourses();
    $favCourse->course_id = $data['course_id'];
    $favCourse->user_id = Auth::getUser()->id;
    $favCourse->save();
});

Route::get('api/favoritesCourses/{courseId}', function ($courseId) {
    $user = Auth::getUser();
    $favCourses = FavoriteCourses::where('user_id', $user->id)->where('course_id', $courseId)->count();
    if ($favCourses == 1) {
        return 1;
    } else {
        return 0;
    }
});

Route::delete('api/deleteFavorite/{courseId}', function ($courseId) {
    $user = Auth::getUser();
    $favCourses = FavoriteCourses::where('user_id', $user->id)->where('course_id', $courseId)->delete();
});

Route::delete('api/deleteComment/{id}', function ($commentId) {
    $comment = Comments::find($commentId);
    $user = Auth::getUser();
    if ($user->id == $comment->user_id) {
        $comment->delete();
    }
});

Route::get('api/favoritesCourses', function () {
    $user = Auth::getUser();
    $favCourses = FavoriteCourses::where('user_id', $user->id)->get();
    $courseModels = [];
    foreach ($favCourses as $key => $favCourse) {
        $course = Course::findOrFail($favCourse->course_id);
        $course->thumbPath = $course->courseThumb->getPath();
        array_push($courseModels, $course);
    }
    return $courseModels;
});
