<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Administrator',
            'email' => 'admin@arca.com',
            'role' => 'admin',
            'password' => Hash::make('hanabi15'),
        ]);

        DB::table('users')->insert([
            'name' => 'Regular User',
            'email' => 'regular@arca.com',
            'role' => 'regular',
            'password' => Hash::make('hanabi15'),
        ]);
    }
}
