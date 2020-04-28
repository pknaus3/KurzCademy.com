<?php


use October\Rain\Auth\Models\User;

Route::post('chcek', function ($req) {
    $data = $req->input();

    $check = new CheckBox();
    $check->user = User::getAuth()->id;
    $check->step_id = $data['step_id'];
    $check->is_checked = $data['is_checked'];
    $check->save();
});
