<?php

namespace Database\Seeders;

use App\Models\Assessment;
use App\Models\AssessmentCriteria;
use App\Models\Company;
use App\Models\Criteria;
use App\Models\Education;
use App\Models\Major;
use App\Models\Position;
use App\Models\Vacancy;
use App\Models\VacancyAssessment;
use App\Models\VacancyEducation;
use App\Models\VacancyMajor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VacancySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $vacancy = Vacancy::create([
            'company_id' => Company::all()->first()->id,
            'position_id' => Position::all()->first()->id,
            'description' => 'Ada lowongan nih, syartnya blablabla'
        ]);

        $assessments = Assessment::all();
        $criterias = Criteria::all();

        $i = 1;
        $criteria = $criterias->first();
        foreach($assessments as $assessment){
            $vacancyAssessment = VacancyAssessment::create([
                'vacancy_id' => $vacancy->id,
                'assessment_id' => $assessment->id,
                'sequence' => $i,
                'treshold' => 80,
                'weight' => round(100/$assessments->count()),
                'count_by_average' => 0,
            ]);

            AssessmentCriteria::create([
                'vacancy_assessment_id' => $vacancyAssessment->id,
                'criteria_id' => $criteria->id,
                'treshold' => 80,
                'weight' => 100,
            ]);

            $criteria = $criterias->slice(1)->first();
            
            if($i == 1){
                AssessmentCriteria::create([
                    'vacancy_assessment_id' => $vacancyAssessment->id,
                    'criteria_id' => $criteria->id,
                    'treshold' => 80,
                    'weight' => 100,
                ]);
    
                $criteria = $criterias->slice(1)->first();
            }

            $i++;
        }

        VacancyEducation::create([
            'vacancy_id' => $vacancy->id,
            'education_id' => Education::all()->first()->id,
        ]);

        VacancyMajor::create([
            'vacancy_id' => $vacancy->id,
            'major_id' => Major::all()->first()->id,
        ]);
    }
}
