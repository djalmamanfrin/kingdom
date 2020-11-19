<?php
/** @var \Laravel\Lumen\Routing\Router $router */
$router->group(['prefix' => 'companies'], function () use ($router) {
    $router->get('/', function () {
        $error = new InvalidArgumentException('Method not allowed', 422);
        return responseHandler()->error($error);
    });

    $router->post('/', [
        'validate' => 'company',
        'middleware' => 'validate_field',
        'uses' => 'CompanyController@store']);

    $router->group(['prefix' => '{id}'], function ($router) {
        $router->patch('/', [
            'validate' => 'company',
            'middleware' => 'validate_field',
            'uses' => 'CompanyController@update']);

        $router->put('/', [
            'validate' => 'company',
            'middleware' => 'validate_field',
            'uses' => 'CompanyController@update']);

        $router->delete('/',    ['uses' => 'CompanyController@delete']);
        $router->get('/',       ['as' => 'company.get', 'uses' => 'CompanyController@get']);
        $router->get('/type',   ['as' => 'company.type', 'uses' => 'CompanyController@type']);
        $router->get('/services',  ['as' => 'company.services', 'uses' => 'CompanyController@products']);
    });
});
