<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;
use Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->upsert([
            'id' => 1,
            'name' => 'Admin',
            'email' => 'Admin@gmail.com',
            'password' => Hash::make('password'),
            'role_id' => 1,
        ],'id');
    }
}
