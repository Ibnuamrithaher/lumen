<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});
// Users
$router->get('/users/', 'UserController@index');
$router->post('/users/', 'UserController@store');
$router->get('/users/{user_id}', 'UserController@show');
$router->put('/users/{user_id}', 'UserController@update');
$router->delete('/users/{user_id}', 'UserController@destroy');
// Produk
$router->get('/produks','ProdukController@index');
$router->post('/produks','ProdukController@store');
$router->get('/produks/{produk_id}','ProdukController@show');
$router->put('/produks/{produk_id}', 'ProdukController@update');
$router->delete('/produks/{produk_id}', 'ProdukController@destroy');

