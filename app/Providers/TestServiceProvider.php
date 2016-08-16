<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Learnlaravel\Test\Services\TestService;

class TestServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //use singleton bind instance
        $this->app->singleton('test', function () {
            return new TestService();
        });

        $this->app->bind('App\Learnlaravel\Test\Contracts\TestContract', function () {
            return new TestService();
        });
    }
}
