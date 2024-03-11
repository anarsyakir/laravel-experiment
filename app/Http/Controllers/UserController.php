<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\UserCollection;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if($search = $request->search_text){
            $user = User::where('name', 'LIKE', '%' . $search . '%')->orderBy('created_at', 'desc');
        } else {
            $user = User::orderBy('created_at', 'desc');
        }
        return Inertia::render('User/List', [
            'users' => new UserCollection($user->paginate(5)),
            'searchText' => $request->search_text
        ]);
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
    public function store(StoreUserRequest $request, CreatesNewUsers $creator)
    {
        $creator->create($request->all());

        return to_route('users.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $data = [
            'name' => $request->name,
            'email' => $request->email
        ];
        if(!empty($request->password)) {
            $data['password'] = Hash::make($request->password);
        }
        $user->update($data);

        return to_route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return to_route('users.index');
    }
}
