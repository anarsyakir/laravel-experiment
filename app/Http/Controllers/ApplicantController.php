<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreApplicantRequest;
use App\Http\Requests\UpdateApplicantRequest;
use App\Http\Resources\ApplicantCollection;
use App\Http\Resources\ApplicantResource;
use App\Models\Applicant;
use App\Models\Vacancy;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ApplicantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return Inertia::render('Applicant/List', [
            'applications' => new ApplicantCollection(
                Applicant::where('user_id', $request->user()->id)->paginate(5)
            )
        ]);
    }

    public function admin(Request $request, Vacancy $vacancy)
    {
        return Inertia::render('Applicant/Admin', [
            'applications' => new ApplicantCollection(
                Applicant::where('vacancy_id', $vacancy->id)->paginate(5)
            )
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreApplicantRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Applicant $applicant)
    {
        return Inertia::render('Applicant/Show', [
            'applicant' => new ApplicantResource($applicant)
        ]);
    }

    public function showAdmin(Applicant $applicant)
    {
        return Inertia::render('Applicant/Show', [
            'applicant' => new ApplicantResource($applicant)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateApplicantRequest $request, Applicant $applicant)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Applicant $applicant)
    {
        //
    }
}
