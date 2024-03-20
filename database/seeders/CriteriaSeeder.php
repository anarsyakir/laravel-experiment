<?php

namespace Database\Seeders;

use App\Models\Criteria;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CriteriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Criteria::factory()->create([
            'name' => 'Pendidikan'
        ]);
        Criteria::factory()->create([
            'name' => 'Jurusan'
        ]);
        Criteria::factory()->create([
            'name' => 'Psikotes'
        ]);
        Criteria::factory()->create([
            'name' => 'Assessment Teknis'
        ]);
        Criteria::factory()->create([
            'name' => 'Bootcamp'
        ]);
        Criteria::factory()->create([
            'name' => 'Wawancara'
        ]);
    }
}
