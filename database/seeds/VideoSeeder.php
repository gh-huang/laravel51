<?php

use Illuminate\Database\Seeder;

class VideoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=1; $i < 6; $i++) { 
        	\App\Models\Video::create([
        		'title' => 'video title' . $i,
        		'content' => 'video conten' . $i,
        		'desc' => 'video ' . $i . 'description',
        		'user_id' => rand(1,3),
        		'status' => rand(0,1),
        	]);
        }
    }
}
