<?php

namespace Database\Seeders;

use App\Models\Assessment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AssessmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Assessment::factory()->create([
            'name' => 'Seleksi Administrasi',
        ]);
        Assessment::factory()->create([
            'name' => 'Psikotes',
        ]);
        Assessment::factory()->create([
            'name' => 'Assessment',
        ]);
        Assessment::factory()->create([
            'name' => 'Bootcamp',
        ]);
        Assessment::factory()->create([
            'name' => 'Interview',
        ]);
    }
}
