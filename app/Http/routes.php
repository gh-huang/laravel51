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

Route::get('/hello/laravel', ['as' => 'laravel', function () {
	echo "hello laravel";
}]);

Route::get('/as', function () {
	return route('laravel');
});

Route::get('/redirect', function () {
	return redirect()->route('laravel');
});

Route::get('/name/{name}', ['as' => 'name', function ($name) {
	echo "my name is " . $name;
}]);

Route::get('/rename/{name}', function ($name) {
	return redirect()->route('name', $name);
});

//test middleware
Route::group(['middleware' => 'test:male'], function () {
	Route::get('/middleware/write', function () {
		echo "this is middleware write";
	});

	Route::get('/middleware/update', function () {
		echo "this is middleware update";
	});
});

Route::get('/age/refuse', ['as' => 'refuse', function () {
	echo "18岁以上男子才能访问！！";
}]);

//Sub-Domain Routing
Route::group(['domain' => '{service}.laravel51.com'], function () {
	Route::get('/write/domain', function ($service) {
		return "Write FROM {$service}.laravel51.com";
	});

	Route::get('/update/domain', function ($service) {
		return "Update FROM {$service}.laravel51.com";
	});
});

//CSRF
Route::get('testCsrf',function(){
    $csrf_field = csrf_field();
    $html = <<<GET
        <form method="POST" action="/testCsrf">
            <input type="submit" value="Test"/>
        </form>
GET;
    return $html;
});

Route::post('testCsrf', function () {
	return 'success';
});

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
