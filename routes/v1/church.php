<?php
/** @var \Laravel\Lumen\Routing\Router $router */

$router->group(['prefix' => 'churches'], function () use ($router) {
    $router->get('/', function () {
        $error = new InvalidArgumentException('Method not allowed', 422);
        return responseHandler()->error($error);
    });

    $router->post('/', [
        'validate' => 'church',
        'middleware' => 'validate_field',
        'uses' => 'ChurchController@store']);

    $router->group(['prefix' => '{id}'], function ($router) {
        $router->patch('/', [
            'validate' => 'church',
            'middleware' => 'validate_field',
            'uses' => 'ChurchController@update']);

        $router->put('/', [
            'validate' => 'church',
            'middleware' => 'validate_field',
            'uses' => 'ChurchController@update']);

        $router->delete('/',      ['as' => 'church.delete', 'uses' => 'ChurchController@delete']);
        $router->get('/',         ['as' => 'church.get', 'uses' => 'ChurchController@get']);
        $router->get('/address',  ['as' => 'church.address', 'uses' => 'ChurchController@address']);
    });
});
