<?php

namespace Database\Seeders;

use App\Models\Hosting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HostingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Hosting::factory()->count(3)->create();
    }
}
