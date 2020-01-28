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
            'state' => '1',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        // Admin: Saeed Khosravi
        DB::table('users')->insert([
            'name' => '',
            'family' => '',
            'email' => 'info@khsoravi.ir',
            'username' => 'sanix',
            'password' => bcrypt('sanix'),
            'rule' => 'admin',
            'state' => '1',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        // Mamber: Siamak Sazgar
        DB::table('users')->insert([
            'name' => 'سیامک',
            'family' => 'سازگار',
            'email' => 'info@azgar.ir',
            'username' => 'sia',
            'password' => bcrypt('sia'),
            'rule' => 'member',
            'state' => '0',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
