<?php
/** @var \Laravel\Lumen\Routing\Router $router */
$router->group(['prefix' => 'users'], function () use ($router) {
    $router->get('/', function () {
        $error = new InvalidArgumentException('Method not allowed', 422);
        return responseHandler()->error($error);
    });

    $router->post('/', [
        'validate' => 'user',
        'middleware' => 'validate_field',
        'uses' => 'UserController@store']);

    $router->group(['prefix' => '{id}'], function ($router) {

        $router->patch('/', [
            'validate' => 'user',
            'middleware' => 'validate_field',
            'uses' => 'UserController@update']);

        $router->put('/', [
            'validate' => 'user',
            'middleware' => 'validate_field',
            'uses' => 'UserController@update']);

        $router->delete('/',           ['uses' => 'UserController@delete']);
        $router->get('/',              ['as' => 'user.get', 'uses' => 'UserController@get']);
        $router->get('/profile',       ['as' => 'user.profile', 'uses' => 'UserController@profile']);
        $router->get('/branches',      ['as' => 'user.branches', 'uses' => 'UserController@branches']);
        $router->get('/companies',    ['as' => 'user.bank_cards', 'uses' => 'UserController@companies']);
        $router->get('/addresses',     ['as' => 'user.addresses', 'uses' => 'UserController@addresses']);
        $router->get('/indications',   ['as' => 'user.indications', 'uses' => 'UserController@indications']);
        $router->get('/notifications', ['as' => 'user.notifications', 'uses' => 'UserController@notifications']);
    });
});
