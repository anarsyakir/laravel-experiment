<?php

namespace Database\Seeders;

use App\Models\Applicant;
use App\Models\User;
use App\Models\Vacancy;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ApplicantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Applicant::create([
            'user_id' => User::firstWhere('email', 'anaroesmana@gmail.com')->id,
            'vacancy_id' => Vacancy::all()->first()->id,
        ]);
    }
}
