<?php
/** @var \Laravel\Lumen\Routing\Router $router */
$router->group(['prefix' => 'services'], function () use ($router) {
    $router->get('/', function () {
        $error = new InvalidArgumentException('Method not allowed', 422);
        return responseHandler()->error($error);
    });

    $router->post('/', [
        'validate' => 'service',
        'middleware' => 'validate_field',
        'uses' => 'ServiceController@store']);

    $router->group(['prefix' => '{id}'], function ($router) {
        $router->patch('/', [
            'validate' => 'service',
            'middleware' => 'validate_field',
            'uses' => 'ServiceController@update']);

        $router->put('/', [
            'validate' => 'service',
            'middleware' => 'validate_field',
            'uses' => 'ServiceController@update']);

        $router->delete('/',    ['uses' => 'ServiceController@delete']);
        $router->get('/',       ['as' => 'service.get', 'uses' => 'ServiceController@get']);
    });
});
