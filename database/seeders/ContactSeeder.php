<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class ContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('contacts')->upsert([
            'id' => 1,
            'name' => 'الفيس بوك',
        ],'id');
        DB::table('contacts')->upsert([
            'id' => 2,
            'name' => 'يوتيوب',
        ],'id');
        DB::table('contacts')->upsert([
            'id' => 3,
            'name' => 'انستجرام',
        ],'id');
        DB::table('contacts')->upsert([
            'id' => 4,
            'name' => 'المبيعات',
        ],'id');
        DB::table('contacts')->upsert([
            'id' => 5,
            'name' => 'الدعم الفني',
        ],'id');
    }
}
