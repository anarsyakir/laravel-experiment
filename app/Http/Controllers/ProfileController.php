<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProfileController extends Controller
{
    public function index(Request $request, User $user)
    {
        if(!$user->id){
            $user = $request->user();
        }

        return Inertia::render('User/Profile', [
            'user' => $user
        ]);
    }
}
