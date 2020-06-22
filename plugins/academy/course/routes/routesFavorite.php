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

Route::post('/api/addFavorite', function (Request $req) {
    $data = $req->input();
    $user = JWTAuth::parseToken()->authenticate();
    if ($user != null) {
        $favCourse = new FavoriteCourses();
        $favCourse->course_id = $data['course_id'];
        $favCourse->user_id = $user->id;
        $favCourse->save();
    }
});

Route::get('api/favoritesCourses/{courseId}', function ($courseId) {
    $user = JWTAuth::parseToken()->authenticate();
    if ($user != null) {
        $favCourses = FavoriteCourses::where('user_id', $user->id)->where('course_id', $courseId)->count();
        if ($favCourses == 1) {
            return 1;
        } else {
            return 0;
        }
    } else {
        return 0;
    }
});

Route::delete('api/deleteFavorite/{courseId}', function ($courseId) {
    $user = JWTAuth::parseToken()->authenticate();
    if ($user != null) {
        $favCourses = FavoriteCourses::where('user_id', $user->id)->where('course_id', $courseId)->delete();
    }
});

Route::get('api/favoritesCourses', function () {
    $user = JWTAuth::parseToken()->authenticate();
    if ($user != null) {
        $favCourses = FavoriteCourses::where('user_id', $user->id)->get();
        $courseModels = [];
        foreach ($favCourses as $key => $favCourse) {
            $course = Course::findOrFail($favCourse->course_id);
            if ($course->courseThumb){
                $course->thumbPath = $course->courseThumb->getPath();
            }
            array_push($courseModels, $course);
        }
        return $courseModels;
    } else {
        return 0;
    }
});

