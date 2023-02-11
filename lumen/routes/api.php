<?php

/** @var \Laravel\Lumen\Routing\Router $router */

$router->get('/', function () use ($router) {
    return 'Hello from index api';
});
$router->get('/auth_check', ['middleware' => 'auth', function (\Illuminate\Http\Request $request) {
    return 'Auth here!';
}]);

