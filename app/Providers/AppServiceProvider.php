<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

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
