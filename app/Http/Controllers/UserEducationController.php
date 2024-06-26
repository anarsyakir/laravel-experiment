<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserEducationRequest;
use App\Http\Requests\UpdateUserEducationRequest;
use App\Models\UserEducation;

class UserEducationController extends Controller
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
    public function store(StoreUserEducationRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = $request->user()->id;

        UserEducation::create($data);

        return to_route('profile.user');
    }

    /**
     * Display the specified resource.
     */
    public function show(UserEducation $userEducation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(UserEducation $userEducation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserEducationRequest $request, UserEducation $userEducation)
    {
        $userEducation->update($request->validated());

        return to_route('profile.user');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UserEducation $userEducation)
    {
        $userEducation->delete();
        
        return to_route('profile.user');
    }
}
