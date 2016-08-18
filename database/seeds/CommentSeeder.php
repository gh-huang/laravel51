<?php

use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$type = ['App\Models\Post', 'App\Models\Video'];
        for ($i=1; $i < 11; $i++) {
        	$key = array_rand($type); 
        	\App\Models\Comment::create([
        		'content' => 'comment ' . $i,
        		'user_id' => rand(1,3),
        		'item_id' => rand(1,5),
        		'item_type' => $type[$key],
        	]);
        }
    }
}
