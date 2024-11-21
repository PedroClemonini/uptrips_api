<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class levelUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('level_user')->insert([
            ['userDescription' => 'Admin'],
            ['userDescription' => 'User'],
            ['userDescription' => 'Guest'],
        ]);
    }
}
