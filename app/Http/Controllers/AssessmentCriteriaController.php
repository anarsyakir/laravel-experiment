<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAssessmentCriteriaRequest;
use App\Http\Requests\UpdateAssessmentCriteriaRequest;
use App\Models\AssessmentCriteria;
use App\Models\Vacancy;
use App\Models\VacancyAssessment;
use Illuminate\Database\Eloquent\Casts\Json;

class AssessmentCriteriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAssessmentCriteriaRequest $request)
    {
        $data = $request->validated();

        $data['reference'] = count($data['reference']) > 0 ? Json::encode($data['reference']) : null;

        $assessmentCriteria = AssessmentCriteria::create($data);

        $vacancyAssessment = VacancyAssessment::find($assessmentCriteria->vacancy_assessment_id);

        $vacancy = Vacancy::find($vacancyAssessment->vacancy_id);

        return to_route('vacancies.edit', ['vacancy' => $vacancy]);
    }

    /**
     * Display the specified resource.
     */
    public function show(AssessmentCriteria $assessmentCriteria)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AssessmentCriteria $assessmentCriteria)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAssessmentCriteriaRequest $request, AssessmentCriteria $assessmentCriteria)
    {
        $data = $request->validated();

        $data['reference'] = count($data['reference']) > 0 ? Json::encode($data['reference']) : null;

        $assessmentCriteria->update($data);
        $vacancyAssessment = VacancyAssessment::find($assessmentCriteria->vacancy_assessment_id);
        $vacancy = Vacancy::find($vacancyAssessment->vacancy_id);

        return to_route('vacancies.edit', ['vacancy' => $vacancy]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AssessmentCriteria $assessmentCriteria)
    {
        $vacancyAssessment = VacancyAssessment::find($assessmentCriteria->vacancy_assessment_id);
        $vacancy = Vacancy::find($vacancyAssessment->vacancy_id);
        $assessmentCriteria->delete();

        return to_route('vacancies.edit', ['vacancy' => $vacancy]);
    }
}
