<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class ForumsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        for($i=0; $i<15;$i++){
        	DB::table('forums')->insert([
        		[
        			'user_id' => $faker->numberBetween($min = 3, $max = 12),
        			'category_id' => $faker->numberBetween($min = 1, $max = 8),
        			'forum_status_id' => $faker->numberBetween($min =1, $max = 2),
        			'title' => 'This is '.$i.' Forum',
        			'description' => $faker->text(100),
        			'created_at' => date('Y-m-d H:i:s'),
	                'updated_at' => date('Y-m-d H:i:s'),
        		]
        	]);
        }
    }
}
