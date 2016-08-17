<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use DB;
use App\Models\Post;

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

        //DB listen
        DB::listen(function($sql, $bindings, $time) {
            echo 'SQL语句执行: ' . $sql . '参数: ' . json_encode($bindings) . '耗时: ' . $time . 'ms<br>';
        });

        //post model listen
        Post::saving(function ($post) {
            echo "saving event is fired <br>";
            // if ($post->user_id == 1) {
            //     return false;
            // }
        });

        Post::creating(function ($post) {
            echo "creating event is fired <br>";
            if ($post->user_id == 1) {
                return false;
            }
        });

        Post::created(function () {
            echo "created event is fired <br>";
        });

        Post::saved(function () {
            echo "saved event is fired <br>";
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
