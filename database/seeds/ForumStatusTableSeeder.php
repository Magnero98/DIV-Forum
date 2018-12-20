<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class ForumStatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('forum_status')->insert([
        	[
    			'name' => 'Open',
        		'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
    		],[
    			'name' => 'Closed',
        		'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
    		]
        ]);
    }
}
