<?php namespace Wezeo\UserApi\Providers;

use Tymon\JWTAuth\Providers\AbstractServiceProvider;
use Wezeo\UserApi\Classes\JWT;

class JWTAuthServiceProvider extends AbstractServiceProvider
{
    /**
     * @inheritDoc
     */
    public function boot()
    {
        $this->aliasMiddleware();

        $this->app->alias('JWTAuth', 'Tymon\JWTAuth\Facades\JWTAuth');
        $this->app->alias('JWTFactory', 'Tymon\JWTAuth\Facades\JWTFactory');
    }

    /**
     * @inheritDoc
     */
    protected function config($key, $default = null)
    {
        return config("wezeo.userapi::$key",
            config("jwt.$key", $default)
        );
    }

    /**
     * Alias the middleware.
     *
     * @return void
     */
    protected function aliasMiddleware()
    {
        $router = $this->app['router'];

        $method = method_exists($router, 'aliasMiddleware') ? 'aliasMiddleware' : 'middleware';

        foreach ($this->middlewareAliases as $alias => $middleware) {
            $router->$method($alias, $middleware);
        }
    }
}
