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

Route::post('/api/comment', function (Request $req) {
    $data = $req->input();
    $user = JWTAuth::parseToken()->authenticate();
    if ($user != null) {
        $comment = new Comments();
        $comment->comment = $data['comment'];
        $comment->course_id = $data['course_id'];
        $comment->user_id = $user->id;
        $comment->save();
    }
});

Route::get('api/comments/{id}', function () {
    $comments = Comments::all();
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

Route::delete('api/deleteComment/{id}', function ($commentId) {
    $comment = Comments::find($commentId);
    $user = JWTAuth::parseToken()->authenticate();
    if ($user->id == $comment->user_id) {
        $comment->delete();
    }
});
