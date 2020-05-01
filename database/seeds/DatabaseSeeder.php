<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         $this->call(TransportTypeTableSeeder::class);
         $this->call(UserTableSeeder::class);
         factory(\App\User::class, 7)->create();
    }
}
