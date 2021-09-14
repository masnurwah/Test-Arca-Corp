<?php

use Illuminate\Database\Seeder;

class BuruhSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('buruh')->insert([
            'name' => 'Sania',
        ]);
        DB::table('buruh')->insert([
            'name' => 'Wahid',
        ]);
        DB::table('buruh')->insert([
            'name' => 'Masnur',
        ]);
        DB::table('buruh')->insert([
            'name' => 'Fitri',
        ]);
    }
}
