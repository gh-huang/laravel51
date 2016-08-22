<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
// use Cache;
use LRedis;
use App\Models\User;
use App\Models\Post;

class RedisController extends Controller
{
    public function redisread()
    {
        $key = 'user:name:1';
        $user = User::find(1);
        if ($user) {
            LRedis::set($key, $user->name);
            $redis = LRedis::connection();
        }

        if (LRedis::exists($key)) {
            dd(LRedis::get($key));
        }
    }

    public function redisscard()
    {
        $key = 'posts:title';
        $posts = Post::all();
        foreach ($posts as $post) {
            LRedis::sadd($key, $post->title);
        }

        $nums = LRedis::scard($key);
        if ($nums > 0) {
            $post_titles = LRedis::srandmember($key, 3);
            dd($post_titles);
        }
    }

}
