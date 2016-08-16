<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Learnlaravel\Test\Services\TestService;
use App\Learnlaravel\Test\Facades\Test;

class TestServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;
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
            // return new TestService();
            return new Test();
        });

        $this->app->bind('App\Learnlaravel\Test\Contracts\TestContract', function () {
            return new TestService();
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['App\Learnlaravel\Test\Contracts\TestContract'];
    } 
}
