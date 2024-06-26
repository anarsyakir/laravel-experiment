<?php

use App\Http\Controllers\ApplicantController;
use App\Http\Controllers\AssessmentCriteriaController;
use App\Http\Controllers\CriteriaController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportingController;
use App\Http\Controllers\UserAddressController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserEducationController;
use App\Http\Controllers\UserExperienceController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\VacancyAssessmentController;
use App\Http\Controllers\VacancyController;
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
    Route::resource('applicants', ApplicantController::class)->except(['edit', 'create', 'store']);
    Route::resource('vacancy-assessment', VacancyAssessmentController::class)->only(['store', 'update', 'destroy']);
    Route::resource('assessment-criteria', AssessmentCriteriaController::class)->only(['store']);
    Route::resource('user-profile', UserProfileController::class)->only(['store']);
    Route::resource('user-address', UserAddressController::class)->only(['store']);
    Route::resource('user-education', UserEducationController::class)->only(['store', 'update', 'destroy']);
    Route::resource('user-experience', UserExperienceController::class)->only(['store', 'update', 'destroy']);
    Route::get('/profile/{user?}', [ProfileController::class, 'index'])->name('profile.user');
    Route::put('/profile/update', [UserController::class, 'updateProfile'])->name('profile.update');
    Route::get('/vacancy/admin', [VacancyController::class, 'admin'])->name('vacancy.admin');
    Route::get('/vacancy/apply/{vacancy}', [VacancyController::class, 'apply'])->name('vacancy.apply');
    Route::put('/applicant/apply', [ApplicantController::class, 'apply'])->name('applicant.apply');
    Route::get('/applicant/admin/{vacancy}', [ApplicantController::class, 'admin'])->name('applicant.admin');
    Route::get('/applicant/show/{applicant}', [ApplicantController::class, 'showAdmin'])->name('applicant.show.admin');
    Route::get('/reporting', [ReportingController::class, 'index'])->name('report.index');
    Route::put('/assessment-criteria/{assessment_criteria}', [AssessmentCriteriaController::class, 'update'])->name('assessment-criteria.update');
    Route::delete('/assessment-criteria/{assessment_criteria}', [AssessmentCriteriaController::class, 'destroy'])->name('assessment-criteria.destroy');
    Route::put('/vacancies/publish/{vacancy}', [VacancyController::class, 'publish'])->name('vacancies.publish');
    Route::post('/get-reference/{name}', [CriteriaController::class, 'reference'])->name('reference');
});
