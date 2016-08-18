<?php

use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=1; $i < 6; $i++) { 
        	\App\Models\Tag::create([
        		'name' => 'tag ' . $i,
        		'nums' => 1,
        	]);
        }
    }
}
