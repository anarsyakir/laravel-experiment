<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserExperienceRequest;
use App\Http\Requests\UpdateUserExperienceRequest;
use App\Models\UserExperience;

class UserExperienceController extends Controller
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
    public function store(StoreUserExperienceRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = $request->user()->id;

        UserExperience::create($data);

        return to_route('profile.user');
    }

    /**
     * Display the specified resource.
     */
    public function show(UserExperience $userExperience)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(UserExperience $userExperience)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserExperienceRequest $request, UserExperience $userExperience)
    {
        $userExperience->update($request->validated());

        return to_route('profile.user');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UserExperience $userExperience)
    {
        $userExperience->delete();
        
        return to_route('profile.user');
    }
}
