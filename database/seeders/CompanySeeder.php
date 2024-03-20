<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\Field;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Company::factory()->create([
            'name' => 'PT. Neuronworks Indonesia',
            'field_id' => Field::all()->first()->id,
        ]);
    }
}
