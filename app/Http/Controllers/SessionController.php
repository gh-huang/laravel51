<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class SessionController extends Controller
{
    public function session(Request $request)
    {
    	$request->session()->push('name.first', 'Winter');
    	$request->session()->push('name.first', 'Summer');
    	// if ($request->session()->has('name')) {
    	// 	$name = $request->session()->get('name');
    	// 	dd($name);
    	// }
    	dd($request->session()->all());
    }
}
