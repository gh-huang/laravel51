<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;

class QbController extends Controller
{
    protected $users;

    public function __construct()
    {
        $this->users = DB::table('users');
    }

    public function insert()
    {
        $insertId = $this->users->insertGetId(['name' => 'test', 'email' => 'test@qq.com', 'password' => 'password', 'phone' => '13802752074']);
        echo $insertId;
    }

    public function update()
    {
        $affected = $this->users->where('id', '3')->update(['name' => 'swift']);
        echo "<br>";
        echo $affected;
    }

    public function delete()
    {
        $deleted = $this->users->where('id', '=', '4')->delete();
        echo "<br>";
        echo $deleted;
    }

    public function select()
    {
        // $user = $this->users->get();
        // $user = $this->users->select('name', 'email')->get();
        // $user = $this->users->where('id', '2')->first();
        // $user = $this->users->lists('name');
        // $user = $this->users->select(DB::raw('name,email'))->where('id', '<', '3')->get();
        $user = $this->users->select('name', 'email')->where('id', '<', '3')->get();
        dd($user);
    }
}
