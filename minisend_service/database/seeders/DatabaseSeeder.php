<?php

namespace Database\Seeders;

use App\Models\Mail;
use App\Models\UserMail;
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
        $this->call(UserTableSeeder::class);
        UserMail::factory(100)->create();
    }
}
