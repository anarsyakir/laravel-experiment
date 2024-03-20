<?php

use App\Http\Controllers\ApplicantController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VacancyController;
use App\Models\Applicant;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('FlowbiteDashboard');
    })->name('dashboard');

    Route::resource('users', UserController::class)->except(['edit', 'create', 'show']);
    Route::resource('vacancies', VacancyController::class)->except(['edit', 'create']);
    Route::resource('applicants', ApplicantController::class)->except(['edit', 'create']);
    Route::get('/profile/{user?}', [ProfileController::class, 'index'])->name('profile.user');
});
