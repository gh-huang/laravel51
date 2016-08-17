<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;

class DatabaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function insert()
    {
        DB::insert('insert into users (name, email, password) values (?, ?, ?)', ['laravel', 'laravel@test.com', '123']);
        DB::insert('insert into users (name, email, password) values (?, ?, ?)', ['taylor', 'taylor@qq.com', '456']);
        DB::insert('insert into user_accounts (user_id, qq, weixin, weibo) values (?, ?, ?, ?)', ['1', '123456', 'testweixin', 'testweibo']);
    }

    public function select()
    {
        //bind param
        // $user = DB::select('select * from users where id = ?', [1]);
        //bind name
        $user = DB::select('select * from users where id = :id', [':id' => 2]);
        dd($user);
    }

    public function update()
    {
        $affected = DB::update('update users set name = :name where id = :id', ['id' => 11, ':name' => 'updatename']);
        echo $affected;
    }

    public function delete()
    {
        $deleted = DB::delete('delete from users where id = :id', [':id' => 12]);
        echo $deleted;
    }

    public function statement()
    {
        $result = DB::statement('drop table test');
        echo $result;
    }
}
