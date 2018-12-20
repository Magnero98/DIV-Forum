<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class ThreadsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        for($i=0; $i<20; $i++){
        	DB::table('threads')->insert([
        		[
        			'user_id' => $faker->numberBetween($min = 3, $max = 12),
        			'forum_id' => $faker->numberBetween($min = 1, $max = 15),
        			'content' => $faker->text(100),
        			'created_at' => date('Y-m-d H:i:s'),
	                'updated_at' => date('Y-m-d H:i:s'),
        		]
        	]);
        }

    }
}
