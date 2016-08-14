<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('phpinfo', function () {
	phpinfo();
});

Route::group(['middleware' => 'auth'], function () {
	Route::get('admin', 'HomeController@index');
});

Route::get('/hello/{id}', function ($id) {
	echo 'hello ' . $id;
});

Route::get('/id/{id}/name/{name}', function ($id, $name) {
	echo "hello " . $name . " id=" . $id;
});

Route::get('/hello/laravel', ['as'=>'laravel', function () {
	echo "hello laravel";
}]);

// auth route
Route::group(['namespace' => 'auth'], function () {
	//Authentication routes
	Route::get('login', 'AuthController@getLogin');
	Route::post('login', 'AuthController@postLogin');
	Route::get('logout', 'AuthController@getLogout');

	//Registration routes
	Route::get('register', 'AuthController@getRegister');
	Route::post('register', 'AuthController@postRegister');

	//Password reset link request routes
	Route::get('password/email', 'PasswordController@getEmail');
	Route::post('password/email', 'PasswordController@postEmail');

	//Password reset routes
	Route::get('password/reset/{token}', 'PasswordController@getReset');
	Route::post('password/reset', 'PasswordController@postReset');

	//github
	Route::get('/auth/github', 'AuthController@redirectToProvider');
	Route::get('/auth/github/callback', 'AuthController@handleProviderCallback');
});
