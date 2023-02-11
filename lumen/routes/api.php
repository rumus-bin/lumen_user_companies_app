<?php

/** @var \Laravel\Lumen\Routing\Router $router */

$router->get('/', function () use ($router) {
    return 'Hello from index api';
});

$router->group(
    [
        'namespace' => 'User'
    ],
    static function () use($router) {
        $router->group(
            [
                'namespace' => 'Auth'
            ],
            static function () use($router) {
                $router->post('/user/sign-in', [
                    'as' => 'user_login',
                    'uses' => 'ApiUserAuthController@login'
                ]);

                $router->post('/user/register', [
                    'as' => 'user_register',
                    'uses' => 'ApiUserAuthController@register'
                ]);
            }
        );
    }
);
