<?php namespace Wezeo\UserApi\Http\Controllers;

use Illuminate\Support\Facades\Event;
use RainLab\User\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;
use Wezeo\UserApi\Classes\UserApiHook;

class LoginApiController extends UserApiController
{
    public function handle()
    {
        $response = [];

        $params = [
            'login' => input('login'),
            'password' => input('password')
        ];

        $user = Auth::authenticate($params, false);
        if ($user->isBanned()) {
            throw new AuthException('rainlab.user::lang.account.banned');
        }

        $token = JWTAuth::fromUser($user);

        Event::fire('wezeo.userapi.beforeReturnUser', [$user]);

        $response = [
            'token' => $token,
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
