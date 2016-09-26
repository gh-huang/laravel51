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

// Route::get('/tests', function () {
	
// });

Route::get('/', function () {
    return view('welcome');
});

Route::get('phpinfo', function () {
	phpinfo();
});

// Route::group(['middleware' => 'auth', 'as' => 'admin'], function () {
// 	Route::get('admin', 'HomeController@index');
// });

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

//Implicit Controllers
Route::controller('request', 'RequestController');

//response
Route::get('testResponse', function () {
	$content = 'Hello Laravel';
	$status = 200;
	$value = 'text/html;charset=utf-8';
	// return response($content, $status)->header('Content-Type', $value)->withCookie('site', 'Laravel51.com', 30, '/', 'laravel.app');
	// return response()->view('test/hello', ['message' => 'Hello Laravel51'])->header('Content', $value);
	// return view('test/hello', ['message' => 'Hello World']);
	// return response()->json(['name' => 'laravel51', 'passwd' => 'laravel51.com']);
	return response()->download(
		realpath(base_path('public/images')) . '/IMG_1501.JPG',
		'Laravel.jpg'
	);
});

Route::get('testResponseRedirect', function () {
	return redirect()->route('laravel');
});

//share data
Route::get('testViewHello', function () {
	return view('test/hello');
});

Route::get('testViewHome', function () {
	return view('test/home');
});

//provider
Route::resource('test', 'TestController');

//learn database facade
Route::get('database/insert', 'DatabaseController@insert');
Route::get('database/select', 'DatabaseController@select');
Route::get('database/update', 'DatabaseController@update');
Route::get('database/delete', 'DatabaseController@delete');
Route::get('database/statement', 'DatabaseController@statement');

//learn database Query Builder
Route::get('qb/insert', 'QbController@insert');
Route::get('qb/select', 'QbController@select');
Route::get('qb/update', 'QbController@update');
Route::get('qb/delete', 'QbController@delete');

//learn Eloquent ORM
Route::get('eloquent', 'PostController@eloquent');
Route::get('eloquent/create', 'PostController@eloquentcreate');
Route::get('eloquent/save', 'PostController@savedata');
Route::get('eloquent/createdata', 'PostController@createdata');
Route::get('eloquent/updatedata', 'PostController@updatedata');
Route::get('eloquent/updatecreate', 'PostController@updatecreate');
Route::get('eloquent/deletedata', 'PostController@deletedata');
Route::get('eloquent/softdelete', 'PostController@softdelete');
Route::get('eloquent/withsoftdelete', 'PostController@withsoftdelete');
Route::get('eloquent/recoversoftdelete', 'PostController@recoversoftdelete');
Route::get('eloquent/scope', 'PostController@scope');
Route::get('eloquent/scopeparam', 'PostController@scopeparam');
Route::get('eloquent/postevent', 'PostController@postevent');


Route::get('eloquent/relationships', 'UserController@index');
Route::get('eloquent/useraccount', 'UserController@useraccount');
Route::get('eloquent/onetomany', 'UserController@onetomany');
Route::get('eloquent/onetomanyuser', 'UserController@onetomanyuser');
Route::get('eloquent/manytomany', 'UserController@manytomany');

Route::get('eloquent/createcountries', 'UserController@createcountries');
Route::get('eloquent/manythrough', 'UserController@manythrough');

Route::get('eloquent/polymorphicvideo', 'UserController@polymorphicvideo');
Route::get('eloquent/polymorphicpost', 'UserController@polymorphicpost');

Route::get('eloquent/polymorphictag', 'UserController@polymorphictag');

//console
Route::get('testartisan', function () {
	$exitCode = Artisan::call('laravel:academy', [
		'name' => 'Laravel',
		'--mark' => '123',
	]);
});

//RESTFul
Route::resource('post', 'PostController');

//cache
Route::get('cache', function () {
	$post = Cache::get('post_1');
	dd($post);
});

//Redis
Route::get('redisread', 'RedisController@redisread');
Route::get('redisscard', 'RedisController@redisscard');

//paginate
Route::get('simplepaginate', 'PostController@simplepaginate');
Route::get('eloquentpaginate', 'PostController@eloquentpaginate');

//log
Route::get('log', 'TestController@log');

//local
Route::get('/lang/{local}', function ($local) {
	App::setLocale($local);
	return view('local');
});

//mail
Route::get('mail/send', 'MailController@send');
Route::get('mail/sendstring', 'MailController@sendstring');
Route::get('mail/attach', 'MailController@attach');

//queue
Route::get('mail/sendReminderEmail/{id}', 'MailController@sendReminderEmail');

//session
Route::get('session', 'SessionController@session');

//phpunit
Route::get('user', 'UserController@testjson');

//RBAC Zizaco/Entrust
Route::get('zizaco', 'ZizacoController@index');
Route::get('zizaco/test', 'ZizacoController@check');

//captcha
Route::any('captcha', function() {
    if (Request::getMethod() == 'POST')
    {
        $rules = ['captcha' => 'required|captcha'];
        $validator = Validator::make(Input::all(), $rules);
        if ($validator->fails())
        {
            echo '<p style="color: #ff0000;">Incorrect!</p>';
        }
        else
        {
            echo '<p style="color: #00ff30;">Matched :)</p>';
        }
    }

    $form = '<form method="post" action="captcha">';
    $form .= '<input type="hidden" name="_token" value="' . csrf_token() . '">';
    $form .= '<p>' . captcha_img() . '</p>';
    $form .= '<p><input type="text" name="captcha"></p>';
    $form .= '<p><button type="submit" name="check">Check</button></p>';
    $form .= '</form>';
    return $form;
});

Route::get('former', function () {
	return view('former');
});

Route::get('agent', function () {
	$browser = Agent::browser();
	$bversion = Agent::version($browser);
	$platform = Agent::platform();
	$pversion = Agent::version($platform);
	echo $browser . '<hr>';
	echo $bversion . '<hr>';
	echo $platform . '<hr>';
	echo $pversion . '<hr>';
});

//image
Route::get('image', function () {
	$img = Image::make('images/IMG_1501.JPG')->resize(200,200)->gamma(1.6);
	return $img->response('jpg');
});

Route::get('git', function () {
	echo "test";
});

Route::get('info', function () {
	phpinfo();
});

Route::get('test', function () {
	echo 'test';
});

Route::post('post', function () {
	echo 'hello world';
});

Route::delete('user', function () {
	print_r('down');
});

Route::get('happy', function () {
	echo 'happy';	
});

Route::get('bad', function () {
	echo 'bad';
});

Route::post('end', function () {
	echo 'end';
});

Route::get('false', function () {
	echo "false";
});

Route::get('loser', function () {
	echo "loser";
	print_r('loser');
});

Route::get('lose', function () {
	print_r('lose');
	var_dump($_REQUEST);
	var_dump($_ENV);
});

Route::get('static', function () {
	var_dump($_SERVER);
});

Route::get('nothing', function () {
	var_dump($_GET);
});

Route::get('one')
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
