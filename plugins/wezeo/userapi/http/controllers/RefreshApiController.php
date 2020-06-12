<?php namespace Wezeo\UserApi\Http\Controllers;

use Illuminate\Support\Facades\Event;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;
use Wezeo\UserApi\Classes\UserApiHook;

class RefreshApiController extends UserApiController
{
    public function handle()
    {
        $response = [];

        if (!$newToken = JWTAuth::parseToken()->refresh()) {
            throw new JWTException();
        }

        $user = JWTAuth::setToken($newToken)->authenticate();

        Event::fire('wezeo.userapi.beforeReturnUser', [$user]);

        $response = [
            'success' => true,
            'token' => $newToken,
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
