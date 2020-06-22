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

require_once('plugins/academy/course/routes/routesFavorite.php');
require_once('plugins/academy/course/routes/routesComment.php');
require_once('plugins/academy/course/routes/routesCheckbox.php');
require_once('plugins/academy/course/routes/routesCourse.php');

Route::post('api/getVideos', function (Request $stepId){
    $data = $stepId->input();
    $videos = Video::where('step_id', $data['step_id'])->get();

    foreach ($videos as $video) {
        $video->user = User::find($video->user_id);
        if (isset($video->user->avatar)) {
            $video->user->avatarPath = $video->user->avatar->getPath();
        }
    }

    return $videos;
});

