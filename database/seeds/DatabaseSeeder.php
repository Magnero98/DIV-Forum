<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RolesTableSeeder::class);
        $this->call(CategoriesTableSeeder::class);
        $this->call(ForumStatusTableSeeder::class);
        $this->call(PopularityStatusTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(ForumsTableSeeder::class);
        $this->call(ThreadsTableSeeder::class);
        $this->call(MessagesTableSeeder::class);
        $this->call(PopularitiesTableSeeder::class);
    }
}
