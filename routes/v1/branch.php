<?php
/** @var \Laravel\Lumen\Routing\Router $router */
$router->group(['prefix' => 'branches'], function () use ($router) {
    $router->get('/', function () {
        $error = new InvalidArgumentException('Method not allowed', 422);
        return responseHandler()->error($error);
    });

    $router->post('/', [
        'validate' => 'branch',
        'middleware' => 'validate_field',
        'uses' => 'BranchController@store']);

    $router->group(['prefix' => '{id}'], function ($router) {
        $router->patch('/', [
            'validate' => 'branch',
            'middleware' => 'validate_field',
            'uses' => 'BranchController@update']);

        $router->put('/', [
            'validate' => 'branch',
            'middleware' => 'validate_field',
            'uses' => 'BranchController@update']);

        $router->delete('/',      ['uses' => 'BranchController@delete']);
        $router->get('/',         ['as' => 'branch.churches', 'uses' => 'BranchController@get']);
        $router->get('/churches', ['as' => 'branch.churches', 'uses' => 'BranchController@churches']);
    });
});
