<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserAccount;
use App\Models\Post;
use App\Models\Role;
use App\Models\Country;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $account = User::find(1)->account;
        dd($account);
    }

    /**
     * useraccount
     */
    public function useraccount()
    {
        $user = UserAccount::find(1)->user;
        dd($user);
    }

    /**
     * one to many
     */
    public function onetomany()
    {
        $posts = User::find(1)->posts()->where('id', '>', 32)->get();
        dd($posts);
    }

    /**
     * one to many user
     */
    public function onetomanyuser()
    {
        $user = Post::find(23)->user;
        dd($user);
    }

    /**
     * many to many
     */
    public function manytomany()
    {
        $user = User::find(1);
        $roles = $user->roles;
        echo 'User#' . $user->name . '\'s roles:<br>';
        foreach ($roles as $role) {
            echo $role->name . '<br>';
        }
        echo "<hr>";
        $role = Role::find(4);
        $users = $role->users;
        echo 'Role#' . $role->name . ' users:<br>';
        foreach ($users as $user) {
            echo $user->name . '<br>';
        }
        echo "<hr>";
        foreach ($roles as $role) {
            echo $role->pivot->role_id . '<br>';
        }
    }

    /**
     * create countries
     */
    public function createcountries()
    {
        $china = [
            'name' => 'china'
        ];
        $american = [
            'name' => 'american'
        ];
        Country::create($china);
        Country::create($american);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
