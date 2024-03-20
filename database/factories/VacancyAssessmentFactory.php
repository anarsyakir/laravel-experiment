<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\VacancyAssessment>
 */
class VacancyAssessmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'vacancy_id' => '',
            'assessment_id' => '',
            'sequence' => '',
            'treshold' => '',
            'weight' => '',
            'count_by_average' => 0,
        ];
    }
}
