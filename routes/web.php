<?php

/** @var \Laravel\Lumen\Routing\Router $router */
$router->group(['prefix' => 'api'], function () use ($router) {
    $router->get('alive', function () {
        return ['status' => true, 'message' => "I'm Alivess"];
    });

    include('versions/v1.php');
});
