<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;


class MessagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        for($i=3; $i<=9; $i++){
        	DB::table('messages')->insert([
        		[
        			'sender_id' => $i,
        			'receiver_id' => $faker->numberBetween($min = $i+1, $max = 12),
        			'content' => $faker->text(20),
        			'created_at' => date('Y-m-d H:i:s'),
	                'updated_at' => date('Y-m-d H:i:s'),
        		]
        	]);
        }
    }
}
