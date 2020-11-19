<?php
/** @var \Laravel\Lumen\Routing\Router $router */
$router->group(['prefix' => 'v1', 'middleware' => 'auth', 'namespace' => 'V1'], function () use ($router) {
    include('user.php');
    include('branch.php');
    include('church.php');
    include('company.php');
    include('service.php');
});
