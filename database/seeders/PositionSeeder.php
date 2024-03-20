<?php

namespace Database\Seeders;

use App\Models\Position;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Position::factory()->create([
            'name' => 'Programmer'
        ]);
        Position::factory()->create([
            'name' => 'System Analyst'
        ]);
        Position::factory()->create([
            'name' => 'Project Manager'
        ]);
        Position::factory()->create([
            'name' => 'Technical Writer'
        ]);
    }
}
