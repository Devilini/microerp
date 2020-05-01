<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'name' => 'Admin',
                'email' => 'admin@admin.ru',
                'password' => bcrypt('12345678'),
                'is_admin' => 1,
                'transport_id' => null,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
            [
                'name' => 'Driver',
                'email' => 'driver@driver.ru',
                'password' => bcrypt('12345678'),
                'is_admin' => 0,
                'transport_id' => 1,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ]
        ];

        \Illuminate\Support\Facades\DB::table('users')->insert($data);
    }
}
