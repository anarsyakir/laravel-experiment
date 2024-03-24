<?php

use App\Http\Controllers\ApplicantController;
use App\Http\Controllers\AssessmentCriteriaController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportingController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VacancyAssessmentController;
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
    Route::resource('vacancies', VacancyController::class);
    Route::resource('applicants', ApplicantController::class)->except(['edit', 'create']);
    Route::resource('vacancy-assessment', VacancyAssessmentController::class)->only(['store', 'update']);
    Route::resource('assessment-criteria', AssessmentCriteriaController::class)->only(['store', 'update']);
    Route::get('/profile/{user?}', [ProfileController::class, 'index'])->name('profile.user');
    Route::get('/vacancy/admin', [VacancyController::class, 'admin'])->name('vacancy.admin');
    Route::get('/applicant/admin/{vacancy}', [ApplicantController::class, 'admin'])->name('applicant.admin');
    Route::get('/applicant/show/{applicant}', [ApplicantController::class, 'showAdmin'])->name('applicant.show.admin');
    Route::get('/reporting', [ReportingController::class, 'index'])->name('report.index');
});
