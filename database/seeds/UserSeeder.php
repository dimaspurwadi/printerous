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
            'name' => 'Admin',
            'email' => 'admin@printerous.com',
            'level' => 1,
            'password' => Hash::make('admin'),
        ]); 
        DB::table('users')->insert([
            'name' => 'Am PT. Abc',
            'email' => 'am@abc.com',
            'level' => 2,
            'password' => Hash::make('admin'),
        ]);
        DB::table('users')->insert([
            'name' => 'Am PT. BCD',
            'email' => 'am@bcd.com',
            'level' => 2,
            'password' => Hash::make('admin'),
        ]); 

    }
}
