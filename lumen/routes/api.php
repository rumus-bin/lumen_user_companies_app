<?php

/** @var \Laravel\Lumen\Routing\Router $router */

$router->get('/', function () use ($router) {
    return 'Hello from index api';
});

$router->group(
    [
        'namespace' => 'User',
        'prefix' => 'user'
    ],
    static function() use($router) {
        $router->group(
            [
                'middleware' => 'auth'
            ],
            static function() use($router) {
                $router->get(
                    '/companies',
                    [
                        'as' => 'users_companies',
                        'uses' => 'ApiUserCompanyController@index'
                    ]
                );
                $router->post(
                    '/companies',
                    [
                        'middleware' => 'transactional',
                        'as' => 'users_add_company',
                        'uses' => 'ApiUserCompanyController@create'
                    ]
                );
            }
        );
        $router->group(
            [
                'namespace' => 'Auth'
            ],
            static function() use($router) {
                $router->post('/sign-in', [
                    'as' => 'user_login',
                    'uses' => 'ApiUserAuthController@login'
                ]);

                $router->post('/register', [
                    'middleware' => 'transactional',
                    'as' => 'user_register',
                    'uses' => 'ApiUserAuthController@register'
                ]);
            }
        );
    }
);

