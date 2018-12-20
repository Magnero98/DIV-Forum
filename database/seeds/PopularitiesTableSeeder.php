<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class PopularitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$faker = Faker::create();
    	for ($i=3; $i <= 9; $i++) { 
    		DB::table('popularities')->insert([
                [
                    'voter_user_id' => $i,
                    'target_user_id' => $faker->numberBetween($min = $i+1, $max = 12),
                    'popularity_status_id' => $faker->numberBetween($min = 1, $max = 2),
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ]
            ]);
    	}
        
    }
}
