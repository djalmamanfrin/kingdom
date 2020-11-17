<?php
/** @var \Laravel\Lumen\Routing\Router $router */
$router->group(['prefix' => 'v1', 'namespace' => 'V1'], function () use ($router) {
    $router->post('/login', [
        'as' => 'auth.login',
        'validate' => 'auth',
        'middleware' => 'validate_field',
        'uses' => 'AuthController@create']);
    $router->group(['prefix' => 'users', 'middleware' => 'auth'], function () use ($router) {
        $router->get('/', ['as' => 'user.get', 'uses' => 'UserController@index']);
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
            $router->get('/bank_cards',    ['as' => 'user.bank_cards', 'uses' => 'UserController@bankCards']);
            $router->get('/bank_accounts', ['as' => 'user.bank_accounts', 'uses' => 'UserController@bankAccounts']);
            $router->get('/addresses',     ['as' => 'user.addresses', 'uses' => 'UserController@addresses']);
            $router->get('/indications',   ['as' => 'user.indications', 'uses' => 'UserController@indications']);
            $router->get('/notifications', ['as' => 'user.notifications', 'uses' => 'UserController@notifications']);
        });
    });
    $router->group(['prefix' => 'branches'], function () use ($router) {
        $router->get('/', ['uses' => 'BranchController@index']);
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
            $router->get('/projects', ['as' => 'branch.projects', 'uses' => 'BranchController@projects']);
        });
    });
    $router->group(['prefix' => 'churches'], function () use ($router) {
        $router->get('/', ['uses' => 'ChurchController@index']);
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
    $router->group(['prefix' => 'projects'], function () use ($router) {
        $router->get('/', ['uses' => 'ProjectController@index']);
        $router->post('/', [
            'validate' => 'project',
            'middleware' => 'validate_field',
            'uses' => 'ProjectController@store']);
        $router->group(['prefix' => '{id}'], function ($router) {
            $router->patch('/', [
                'validate' => 'project',
                'middleware' => 'validate_field',
                'uses' => 'ProjectController@update']);
            $router->put('/', [
                'validate' => 'project',
                'middleware' => 'validate_field',
                'uses' => 'ProjectController@update']);
            $router->delete('/',    ['uses' => 'ProjectController@delete']);
            $router->get('/',       ['as' => 'project.get', 'uses' => 'ProjectController@get']);
            $router->get('/type',   ['as' => 'project.type', 'uses' => 'ProjectController@type']);
            $router->get('/products',  ['as' => 'project.products', 'uses' => 'ProjectController@products']);
        });
    });
    $router->group(['prefix' => 'bank-accounts'], function () use ($router) {
        $router->get('/', ['uses' => 'BankAccountController@index']);
        $router->post('/', [
            'validate' => 'bank_account',
            'middleware' => 'validate_field',
            'uses' => 'BankAccountController@store']);
        $router->group(['prefix' => '{id}'], function ($router) {
            $router->patch('/', [
                'validate' => 'bank_account',
                'middleware' => 'validate_field',
                'uses' => 'BankAccountController@update']);
            $router->put('/', [
                'validate' => 'bank_account',
                'middleware' => 'validate_field',
                'uses' => 'BankAccountController@update']);
            $router->delete('/',    ['uses' => 'BankAccountController@delete']);
            $router->get('/',       ['as' => 'bank_account.get', 'uses' => 'BankAccountController@get']);
        });
    });

});
