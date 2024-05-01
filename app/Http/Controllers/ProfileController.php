<?php

namespace App\Http\Controllers;

use App\Http\Resources\EducationResource;
use App\Http\Resources\MajorResource;
use App\Http\Resources\PositionResource;
use App\Http\Resources\UserEducationCollection;
use App\Http\Resources\UserExperienceCollection;
use App\Models\Education;
use App\Models\Major;
use App\Models\Position;
use App\Models\User;
use App\Models\UserEducation;
use App\Models\UserExperience;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProfileController extends Controller
{
    public function index(Request $request, User $user)
    {
        $profile = $request->user()->profile();
        $address = $request->user()->address();
        $educations = $request->user()->educations();
        $experiences = $request->user()->experiences();

        $dataProfile = [
            'phone_number' => '', 
            'birth_date' => '', 
            'birth_place' => ''
        ];

        $dataAddress = [
            'address_line' => '',
            'country' => '',
            'province' => '',
            'city' => '',
            'district' => ''
        ];

        if($dataA = $address->first()){
            $dataAddress = $dataA->only(['address_line', 'country', 'province', 'city', 'district']);
        }

        if($dataP = $profile->first()){
            $dataProfile = $dataP->only(['phone_number', 'birth_date', 'birth_place']);
        }

        return Inertia::render('User/Profile', [
            'profile' => $dataProfile,
            'address' => $dataAddress,
            'userEducations' => new UserEducationCollection(UserEducation::where('user_id', $request->user()->id)->paginate(5)),
            'userExperiences' => new UserExperienceCollection(UserExperience::where('user_id', $request->user()->id)->paginate(5)),
            'educations' => EducationResource::collection(Education::all()),
            'majors' => MajorResource::collection(Major::all()),
            'positions' => PositionResource::collection(Position::all())
        ]);
    }
}
