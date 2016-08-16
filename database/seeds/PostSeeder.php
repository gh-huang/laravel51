<?php

use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=0; $i < 10; $i++) {
        	\App\Models\Post::create([
        		'title' => 'Title '. $i,
        		'content' => 'Content '. $i,
        		'user_id' => rand(1,3),
        	]);
        }
    }
}
