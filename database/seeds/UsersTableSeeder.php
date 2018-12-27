<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$faker = Faker::create();
    	$gender = $faker->randomElement(['Male', 'Female']);
    	for($i=0; $i<2; $i++){
	        DB::table('users')->insert([
	        	[
	        		'role_id' => '1',
	        		'name' => $faker->name($gender),
	        		'email' => $faker->email,
	        		'password' => bcrypt('secret'),
	        		'phone' => $faker->phoneNumber,
	        		'birthday' => $faker->dateTimeBetween('-65 years', '-18 years'),
	        		'gender' => $gender,
	        		'address' => $faker->address,
	        		'profile_picture' => 'myPic'.$i.'.png',
	        		'good_popularity' => $faker->randomNumber($nbDigits = 2),
					'bad_popularity' => $faker->randomNumber($nbDigits = 2),
	        		'created_at' => date('Y-m-d H:i:s'),
	                'updated_at' => date('Y-m-d H:i:s'),
	        	]
	        ]);
	    }

    	for($i=0; $i<10; $i++){
	        DB::table('users')->insert([
	        	[
	        		'role_id' => '2',
	        		'name' => $faker->name($gender),
	        		'email' => $faker->email,
	        		'password' => bcrypt('secret'),
	        		'phone' => $faker->phoneNumber,
	        		'birthday' => $faker->dateTimeBetween('-65 years', '-18 years'),
	        		'gender' => $gender,
	        		'address' => $faker->address,
	        		'profile_picture' => 'myPic'.$i.'.png',
	        		'good_popularity' => $faker->randomNumber($nbDigits = 2),
					'bad_popularity' => $faker->randomNumber($nbDigits = 2),
	        		'created_at' => date('Y-m-d H:i:s'),
	                'updated_at' => date('Y-m-d H:i:s'),
	        	]
	        ]);
	    }
    }
}
