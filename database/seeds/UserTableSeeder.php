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
        // Admin: Alireza Bazargani
        DB::table('users')->insert([
            'name' => 'علیرضا',
            'family' => 'بازرگانی',
            'email' => 'info@arbazargani.ir',
            'username' => 'root',
            'password' => bcrypt('root'),
            'rule' => 'admin',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
