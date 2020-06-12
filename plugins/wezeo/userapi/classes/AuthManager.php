<?php namespace Wezeo\UserApi\Classes;

use \RainLab\User\Classes\AuthManager as AuthManagerBase;
use Wezeo\UserApi\Models\User;

class AuthManager extends AuthManagerBase
{
    protected $userModel = User::class;
}
