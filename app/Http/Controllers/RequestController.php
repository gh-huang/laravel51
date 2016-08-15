<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

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

    public function getMethod(Request $request)
    {
        if (!$request->isMethod('get')) {
            abort(404);
        }
        $method = $request->method();
        echo $method;
    }

    public function getInputData(Request $request)
    {
        $name = $request->input('name', 'Laravel');
        echo $name;
        echo "<br>";
        echo $request->input('test.0.name');

        $allData = $request->all();
        $onlyData = $request->only('name', 'hello');
        $exceptData = $request->except('hello');

        echo '<pre>';
        print_r($allData);
        print_r($onlyData);
        print_r($exceptData);
    }

    public function getLastRequest(Request $request)
    {
        // $request->flash();
        return redirect('/request/current-request')->withInput();
    }

    public function getCurrentRequest(Request $request)
    {
        $lastRequestData = $request->old();
        echo '<pre>';
        print_r($lastRequestData);
    }

    public function getCookie(Request $request)
    {
        // $cookies = $request->cookie();
        // dd($cookies);
        $cookie = $request->cookie('website');
        echo $cookie;
    }

    public function getAddCookie()
    {
        $response = new Response();
        $response->withCookie(cookie('website', 'Laravel51.com', 1));
        return $response;
    }

    public function getFileupload()
    {
        $postUrl = '/request/fileupload';
        $csrf_field = csrf_field();
        $html = <<<CREATE
        <form action="$postUrl" method="POST" enctype="multipart/form-data">
        $csrf_field
        <input type="file" name="file"><br/><br/>
        <input type="submit" value="提交"/>
        </form>
CREATE;
        return $html;
    }

    public function postFileupload(Request $request)
    {
        if (!$request->hasFile('file')) {
            exit('not file');
        }
        $file = $request->file('file');
        if (!$file->isValid()) {
            exit('error upload file');
        }
        $destPath = public_path('images');
        if (!realpath($destPath)) {
            mkdir($destPath,0755,true);
        }
        $filename = $file->getClientOriginalName();
        if (!$file->move($destPath, $filename)) {
            exit('error save file');
        }
        exit('success upload file');
    }
}
