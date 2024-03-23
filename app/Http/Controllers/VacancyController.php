<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreVacancyRequest;
use App\Http\Requests\UpdateVacancyRequest;
use App\Http\Resources\CompanyResource;
use App\Http\Resources\PositionResource;
use App\Http\Resources\VacancyCollection;
use App\Http\Resources\VacancyResource;
use App\Models\Company;
use App\Models\Position;
use App\Models\Vacancy;
use Inertia\Inertia;

class VacancyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Vacancy/List', [
            'vacancies' => new VacancyCollection(Vacancy::paginate(5))
        ]);
    }

    public function admin()
    {
        return Inertia::render('Vacancy/Admin', [
            'vacancies' => new VacancyCollection(Vacancy::paginate(5))
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Vacancy/CreateOrEdit', [
            'companies' => CompanyResource::collection(Company::all()),
            'positions' => PositionResource::collection(Position::all())
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreVacancyRequest $request)
    {
        $vacancy = Vacancy::create($request->validated());
        return to_route('vacancies.edit', ['vacancy' => $vacancy]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Vacancy $vacancy)
    {
        return Inertia::render('Vacancy/Show', [
            'vacancy' => new VacancyResource($vacancy)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Vacancy $vacancy)
    {
        return Inertia::render('Vacancy/CreateOrEdit', [
            'companies' => CompanyResource::collection(Company::all()),
            'positions' => PositionResource::collection(Position::all()),
            'vacancy' => new VacancyResource($vacancy)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateVacancyRequest $request, Vacancy $vacancy)
    {
        $vacancy->update($request->validated());

        return to_route('vacancies.edit', ['vacancy' => $vacancy]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Vacancy $vacancy)
    {
        //
    }
}
