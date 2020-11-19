<?php

/** @var \Laravel\Lumen\Routing\Router $router */
$router->group(['prefix' => 'api'], function () use ($router) {
    $router->get('alive', function () {
        return ['status' => true, 'message' => "I'm Alivess"];
    });

    $router->post('/login', [
        'as' => 'auth.login',
        'validate' => 'auth',
        'middleware' => 'validate_field',
        'uses' => 'AuthController@create']);

    include('v1/v1.php');
});
