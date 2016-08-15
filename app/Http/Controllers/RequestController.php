<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class RequestController extends Controller
{
    public function getBasetest(Request $request)
    {
        $input = $request->input('test');
        echo $input;
    }

    public function getUrl(Request $request)
    {
        if (!$request->is('request/*')) {
            abort(404);
        }
        $uri = $request->path();
        $url = $request->url();
        echo $uri;
        echo "<br>";
        echo $url;
    }
}
