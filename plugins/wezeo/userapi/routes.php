<?php

Route::group([
    'prefix' => config('wezeo.userapi::routes.prefix'),
    'middleware' => config('wezeo.userapi::routes.middlewares', [])
], function () {
    $actions = config('wezeo.userapi::routes.actions', []);
    foreach ($actions as $action) {
        Route::{$action['method']}($action['route'], $action['controller'])->middleware($action['middlewares']);
    }
});
