<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Mail;

class MailController extends Controller
{
    public function send()
    {
    	$name = 'laravel';
    	$flag = Mail::send('emails/test', ['name' => $name], function ($message) {
    		$to = '1149522625@qq.com';
    		$message->to($to)->subject('测试邮件');
    	});
    	if ($flag) {
    		echo "success";
    	} else {
    		echo "false";
    	}
    }

    public function sendstring()
    {
    	Mail::raw('this is test mail form laravel51 huang', function ($message) {
    		$to = '1149522625@qq.com';
    		$message->to($to)->subject('test mail');
    	});
    }

    public function attach()
    {
    	$name = 'laravel';
    	$imgPath = 'http://www.laravel51.com/images/IMG_1501.jpg';
    	$flag = Mail::send('emails/test', ['name' => $name], function ($message) {
    		$to = '1149522625@qq.com';
    		$message->to($to)->subject('goods');
    		$attachment = storage_path('app/files/test.txt');
    		$message->attach($attachment, ['as' => "=?UTF-8?B?".base64_encode('测试文档')."?=.txt"]);
    	});
    	if ($flag) {
    		echo "success";
    	} else {
    		echo "false";
    	}
    }
}
