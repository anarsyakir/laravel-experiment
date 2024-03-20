<?php

namespace Database\Seeders;

use App\Models\Education;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MasterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->call([
            AssessmentSeeder::class,
            CriteriaSeeder::class,
            FieldSeeder::class,
            EducationSeeder::class,
            PositionSeeder::class,
            MajorSeeder::class,
            CompanySeeder::class,
        ]);
    }
}
