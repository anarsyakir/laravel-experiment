<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreVacancyAssessmentRequest;
use App\Http\Requests\UpdateVacancyAssessmentRequest;
use App\Models\Vacancy;
use App\Models\VacancyAssessment;

class VacancyAssessmentController extends Controller
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
    public function store(StoreVacancyAssessmentRequest $request)
    {
        $vacancyAssessment = VacancyAssessment::create($request->validated());

        $vacancy = Vacancy::find($vacancyAssessment->vacancy_id);

        return to_route('vacancies.edit', ['vacancy' => $vacancy]);
    }

    /**
     * Display the specified resource.
     */
    public function show(VacancyAssessment $vacancyAssessment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(VacancyAssessment $vacancyAssessment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateVacancyAssessmentRequest $request, VacancyAssessment $vacancyAssessment)
    {
        $vacancyAssessment->update($request->validated());
        $vacancy = Vacancy::find($vacancyAssessment->vacancy_id);

        return to_route('vacancies.edit', ['vacancy' => $vacancy]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(VacancyAssessment $vacancyAssessment)
    {
        $vacancy = Vacancy::find($vacancyAssessment->vacancy_id);
        $vacancyAssessment->delete();
        return to_route('vacancies.edit', ['vacancy' => $vacancy]);
    }
}
