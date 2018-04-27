<?php

use Illuminate\Database\Seeder;
use App\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Mustafa Segun',
            'email' => 'segsalerty@gmail.com',
            'password' => bcrypt('alwaysalert'),
            'role' => 1
        ]);
    }
}
