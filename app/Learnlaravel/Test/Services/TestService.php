<?php
namespace App\Learnlaravel\Test\Services;

use App\Learnlaravel\Test\Contracts\TestContract;

class TestService implements TestContract
{
	public function callMe($controller)
	{
		dd('Call Me From TestServiceProvider In ' . $controller);
	}

	public function sayHello()
	{
		echo "hello world";
	}
}