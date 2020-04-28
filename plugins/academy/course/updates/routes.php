<?php


use October\Rain\Auth\Models\User;

Route::post('chcek', function ($req) {
    $check = new CheckBox();
    $check->user = User::getAuth()->id;
    $check->step_id = $req['step_id'];
    $check->is_checked = $req['is_checked'];
    $check->save();
});
