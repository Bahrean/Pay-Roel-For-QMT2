<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            //admin
            [
                'name' => 'Admin',
            
                'email' => 'admin@gmail.com',
                'password' => Hash::make('123456'),
                'role' => 'admin',
                'status' => 'active',
            
            ],

            //Agriculture Expert
            [
                'name' => 'Agriculture Expert',
                'email' => 'agriexpert@gmail.com',
                'password' => Hash::make('123456'),

                'role' => 'agri_expert',
                'status' => 'active',
            ],

        ]);
    }
}
