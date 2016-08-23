<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ExampleTest extends TestCase
{
    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function testBasicExample()
    {
        // $this->visit('/register')
        // 	 ->type('phpunit', 'name')
        // 	 ->type('11111@qq.com', 'email')
        // 	 ->type('12345678911', 'phone')
        // 	 ->type('password', 'password')
        // 	 ->type('password', 'password_confirmation')
        // 	 ->press('Register')
        // 	 ->seePageIs('/admin');
        // $this->get('/user')
        // 	 ->seeJson([
        // 	 	'name' => 'huang'
        // 	 ]);
        // $user = factory(App\Models\User::class)->create();
        // $this->actingAs($user)
        // 	 ->visit('/admin')
        // 	 ->see('Welcome');
        $this->seeInDatabase('users', ['email' => 'hgh110720@163.com']);
    }
}
