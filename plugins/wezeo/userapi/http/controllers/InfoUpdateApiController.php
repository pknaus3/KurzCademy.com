<?php namespace Wezeo\UserApi\Http\Controllers;

use Illuminate\Support\Facades\Event;
use Tymon\JWTAuth\Facades\JWTAuth;
use Wezeo\UserApi\Classes\UserApiHook;

class InfoUpdateApiController extends UserApiController
{
    public function handle()
    {
        $response = [];

        $data = post();
        $user = JWTAuth::user();

        $user->fill($data);

        if (array_has($data, 'avatar') && empty($data['avatar']) && $user->avatar) {
            $user->avatar->delete();
            $user->avatar = null;
        }

        if (request()->hasFile('avatar')) {
            $user->avatar = request()->file('avatar');
        }

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
