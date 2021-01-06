<?php
/** @var \Laravel\Lumen\Routing\Router $router */
$router->get('/search', ['as' => 'kingdom.search', 'uses' => 'KingdomController@search']);
