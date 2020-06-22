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

Route::post('api/check', function (Request $req) {
    $data = $req->input();

    $user = JWTAuth::parseToken()->authenticate();
    $check = new CheckBox();
    $check->user = $user->id;
    $check->step_id = $data['step_id'];
    $check->is_checked = 1;
    $check->save();
});

Route::post('api/uncheck/', function (Request $stepId) {
    $data = $stepId->input();
    $user = JWTAuth::parseToken()->authenticate();
    $checkbox = CheckBox::where('step_id', $data['step_id'])->where('user_id', $user->id)->first();
    if ($user->id == $checkbox->user_id) {
        $checkbox->delete();
    }
});

Route::post('api/getCheck/', function (Request $stepId) {
    $data = $stepId->input();

    $user = JWTAuth::parseToken()->authenticate();
    $checkbox = CheckBox::where('step_id', $data['step_id'])->where('user_id', $user->id)->first();
    if (isset($checkbox) == 1) {
        if ($user->id == $checkbox->user_id && $checkbox->is_checked == 1) {
            return 1;
        }
    } else {
        return 0;
    }
});
