<?php namespace Wezeo\UserApi\Http\Controllers;

use Illuminate\Support\Facades\Event;
use Tymon\JWTAuth\Facades\JWTAuth;
use Wezeo\UserApi\Classes\UserApiHook;

class InfoUpdateApiController extends UserApiController
{
    public function handle()
    {
        $response = [];

        $user = JWTAuth::user();

        $user->fill(post());
        $user->save();

        Event::fire('wezeo.userapi.beforeReturnUser', [$user]);

        $response = [
            'user' => $user
        ];

        return $afterProcess = UserApiHook::hook('afterProcess', [$this, $response], function () use ($response) {
            return response()->make([
                'response' => $response,
                'status' => 200
            ], 200);
        });
    }
}
