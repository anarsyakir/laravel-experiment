<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreApplicantRequest;
use App\Http\Requests\UpdateApplicantRequest;
use App\Http\Resources\ApplicantCollection;
use App\Http\Resources\ApplicantResource;
use App\Models\Applicant;
use App\Models\ApplicantDocument;
use App\Models\Vacancy;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
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
    public function apply(StoreApplicantRequest $request)
    {
        $applicant = Applicant::create([
            'vacancy_id' => $request->vacancy_id,
            'user_id' => auth()->user()->id,
        ]);

        $criteriaInputs = $request->all();
        foreach($criteriaInputs as $key => $input){
            if($key != 'vacancy_id' && $key != '_method'){
                $key = str_replace('_', '-', $key);
                $value = $input;
                if($input instanceof UploadedFile){
                    $path = '/documents/'.$request->vacancy_id.'/'.$applicant->id.'/';
                    $fullpath = $path . $key . '.' . $input->clientExtension();
                    $input->storeAs($fullpath);
                    $value = $fullpath;
                }

                ApplicantDocument::create([
                    'applicant_id' => $applicant->id,
                    'criteria_id' => $key,
                    'value' => $value
                ]);
            }
        }

        return to_route('vacancies.index');
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
