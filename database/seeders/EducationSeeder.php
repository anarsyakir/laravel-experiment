<?php

namespace Database\Seeders;

use App\Models\Education;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EducationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Education::factory()->create([
            'name' => 'SMK'
        ]);
        Education::factory()->create([
            'name' => 'SMA'
        ]);
        Education::factory()->create([
            'name' => 'S1'
        ]);
        Education::factory()->create([
            'name' => 'S2'
        ]);
        Education::factory()->create([
            'name' => 'S3'
        ]);
    }
}
