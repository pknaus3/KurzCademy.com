<?php namespace Wezeo\UserApi\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Request;
use Wezeo\UserApi\Classes\ApiError;
use Wezeo\UserApi\Classes\UserApiHook;

abstract class UserApiController extends Controller
{
    public abstract function handle();

    public function __invoke(Request $request)
    {
        try {
            return UserApiHook::hook('beforeProcess', [$this], function () {
                return $this->handle();
            });
        } catch (\Exception $exception) {
            return UserApiHook::hook('beforeReturnException', [$this, $exception], function () use ($exception) {
                return ApiError::response($exception);
            });
        }
    }
}
