<?php namespace Wezeo\UserApi\Http\Controllers;

use Wezeo\UserApi\Classes\UserApiHook;

class VerifyResendApiController extends UserApiController
{
    public function handle()
    {
        $response = [];

        return $afterProcess = UserApiHook::hook('afterProcess', [$this, $response], function () use ($response) {
            return response()->make([
                'response' => $response,
                'status' => 200
            ], 200);
        });
    }
}
