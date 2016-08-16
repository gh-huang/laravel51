<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use DB;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //share data
        view()->share('sitename', 'laravel51');

        //view composer
        view()->composer('test/hello', function ($view) {
            $view->with('user', array('name' => 'test', 'avatar' => '/path/to/test.jpg'));
        });

        DB::listen(function($sql, $bindings, $time) {
            echo 'SQL语句执行: ' . $sql . '参数: ' . json_encode($bindings) . '耗时: ' . $time . 'ms';
        });

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
