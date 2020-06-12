<?php namespace Wezeo\UserApi\Http\Controllers;

use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Validator;
use October\Rain\Exception\ValidationException;
use RainLab\User\Facades\Auth;
use RainLab\User\Models\Settings as UserSettings;
use Tymon\JWTAuth\Facades\JWTAuth;
use Wezeo\UserApi\Classes\UserApiHook;

class SignupApiController extends UserApiController
{
    public function handle()
    {
        $data = post();

        if (!array_key_exists('password_confirmation', $data)) {
            $data['password_confirmation'] = post('password');
        }

        $rules = [
            'email' => 'required|email|between:6,255',
            'password' => 'required|between:4,255|confirmed'
        ];

        if ($this->loginAttribute() == UserSettings::LOGIN_USERNAME) {
            $rules['username'] = 'required|between:2,255';
        }

        $validation = Validator::make($data, $rules);
        if ($validation->fails()) {
            throw new ValidationException($validation);
        }

        $user = $this->registerUser($data);

        $token = null;
        if ($user->is_activated) {
            $token = JWTAuth::fromUser($user);
        }

        Event::fire('wezeo.userapi.beforeReturnUser', [$user]);

        $response = [
            'token' => $token,
            'user' => $user
        ];

        return $afterProcess = UserApiHook::hook('afterProcess', [$this, $response], function () use ($response) {
            return response()->make([
                'response' => $response,
                'status' => 201
            ], 201);
        });
    }

    protected function registerUser($data)
    {
        Event::fire('rainlab.user.beforeRegister', [&$data]);

        $automaticActivation = UserSettings::get('activate_mode') == UserSettings::ACTIVATE_AUTO;
        $userActivation = UserSettings::get('activate_mode') == UserSettings::ACTIVATE_USER;
        $user = Auth::register($data, $automaticActivation);

        Event::fire('rainlab.user.register', [$user, $data]);

        if ($userActivation && !$user->is_activated) {
            $this->sendActivationEmail($user);
        }

        return $user;
    }

    protected function loginAttribute()
    {
        return UserSettings::get('login_attribute', UserSettings::LOGIN_EMAIL);
    }

    protected function sendActivationEmail($user)
    {
        $activationCode = $user->getActivationCode();
        return Event::fire('wezeo.userapi.sendActivationEmail', [$user, $activationCode], true);
    }
}
