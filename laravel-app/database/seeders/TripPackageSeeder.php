<?php

namespace Database\Seeders;

use App\Models\TripPackage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TripPackageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TripPackage::factory()->count(3)->create();
    }
}
