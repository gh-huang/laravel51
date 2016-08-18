<?php

use Illuminate\Database\Seeder;

class TaggableSeeder extends Seeder
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
        	\App\Models\Taggable::create([
        		'taggable_id' => rand(1,5),
        		'taggable_type' => $type[$key],
        		'tag_id' => rand(1,5),
        	]);
        }
    }
}
