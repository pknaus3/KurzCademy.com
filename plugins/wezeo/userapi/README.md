# User API

## Description
Implement auth API for RainLab.User plugin

## Installation
1. Copy files to `plugins/wezeo/userapi` directory
    - Via git submodules
        ```bash
        git submodule add https://gitlab.com/wezeo/ocms-plugins/userapi plugins/wezeo/userapi
        ```
    - Via git clone
        ```bash
        git clone https://gitlab.com/wezeo/ocms-plugins/userapi plugins/wezeo/userapi
        ```
2. Update composer dependencies
    ```bash
    composer update
    ```
3. Generate JWT secret key
    ```bash
    php artisan jwt:secret 
    ```
4. Set env variables

## ENV variables
- `JWT_SECRET`
    - Secret key will be used for Symmetric algorithms only (HMAC)
    - default: config('app.key')
- `JWT_TTL`
    - Time (in minutes) that the token will be valid for
    - default: 60 (1 hour)
- `JWT_REFRESH_TTL`
    - Time (in minutes) that the token can be refreshed
    - default: 20160 (2 weeks)

## Events
- Before process the controller action
    ```php
    Event::listen('wezeo.userapi.beforeProcess', function ($controller) {
      
        if (!$controller instanceof SignupApiController) {
            return;
        }
          
        return response()->make([
            'success' => true
        ], 201);
    });
    ```
- After process the controller action
    ```php
    Event::listen('wezeo.userapi.afterProcess', function ($controller, $data) {
    
        if (!$controller instanceof SignupApiController) {
            return;
        }
    
        return response()->make($data, 201);
    });
    ```
- Before return user in the response
    ```php
    Event::listen('wezeo.userapi.beforeReturnUser', function ($user) {
        $user->additional = 'userapi';
    });
    ```
- Send activation email after user sign up
    ```php
        Event::listen('wezeo.userapi.sendActivationEmail', function ($user) {
            return Mail::send(...);
        });
    ```
