<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'first_name' => 'Test',
                'last_name' => 'User',
                'email' => 'mini@send.com',
                'password' => bcrypt('password')
            ]
        ]);
    }
}
