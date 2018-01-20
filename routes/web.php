<?php

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
// use App\User;
$router->get('/', function () use ($router) {
	return $router->app->version();
});
$router->group(['prefix' => 'api'], function () use ($router) {
	$router->get('admin', ['uses' => 'AdminController@showAdmin']);

	$router->get('admin/{id}', ['uses' => 'AdminController@showOneAdmin']);

	$router->post('admin', ['uses' => 'AdminController@create']);

	$router->delete('admin/{id}', ['uses' => 'AdminController@delete']);

	$router->post('admin/{id}', ['uses' => 'AdminController@update']);
	//user
	$router->get('user', ['uses' => 'UserController@showUser']);

	$router->get('user/{id}', ['uses' => 'UserController@showOneUser']);

	$router->post('user', ['uses' => 'UserController@create']);

	$router->delete('user/{id}', ['uses' => 'UserController@delete']);

	$router->post('user/{id}', ['uses' => 'UserController@update']);
	//app
	$router->get('app', ['uses' => 'AppController@showApp']);

	$router->get('app/{id}', ['uses' => 'AppController@showOneApp']);

	$router->post('app', ['uses' => 'AppController@create']);

	$router->delete('app/{id}', ['uses' => 'AppController@delete']);

	$router->post('app/{id}', ['uses' => 'AppController@update']);
	//version
	$router->get('version', ['uses' => 'VersionController@showAdmin']);

	$router->get('version/{id}', ['uses' => 'VersionController@showOneAdmin']);

	$router->post('version', ['uses' => 'VersionController@create']);

	$router->delete('version/{id}', ['uses' => 'VersionController@delete']);

	$router->post('version/{id}', ['uses' => 'VersionController@update']);
});
