<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PopularityStatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('popularity_status')->insert([
        	[
    			'name' => 'Good',
        		'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
    		],[
    			'name' => 'Bad',
        		'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
    		]
        ]);
    }
}
