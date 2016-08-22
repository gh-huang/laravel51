<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Learnlaravel\Test\Contracts\TestContract;
use TestClass;
use Log;

class TestController extends Controller
{
    protected $test;

    public function __construct(TestContract $test)
    {
        $this->test = $test;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $this->test->callMe(\Route::current()->getActionName());
        // $this->test->sayHello();
        TestClass::doSomething();
    }

    public function log()
    {
        Log::emergency('系统挂掉了');
        Log::alert('数据库访问异常');
        Log::critical('系统出现未知错误');
        Log::error('指定变量不存在');
        Log::warning('该方法已经废弃');
        Log::notice('用户异地登录');
        Log::info('用户XXX登录成功');
        Log::debug('调试信息');

        $monolog = Log::getMonolog();
        dd($monolog);
    }
}
