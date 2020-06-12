<?php namespace Wezeo\UserApi\Http\Controllers;

use Tymon\JWTAuth\Facades\JWTAuth;
use Wezeo\UserApi\Classes\UserApiHook;

class InvalidateApiController extends UserApiController
{
    public function handle()
    {
        $response = [];

        $token = JWTAuth::parseToken()->getToken();
        JWTAuth::invalidate($token);

        $response = [
            'success' => true
        ];

        return $afterProcess = UserApiHook::hook('afterProcess', [$this, $response], function () use ($response) {
            return response()->make([
                'response' => $response,
                'status' => 200
            ], 200);
        });
    }
}
