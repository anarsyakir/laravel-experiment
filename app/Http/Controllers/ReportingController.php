<?php

namespace App\Http\Controllers;

use App\Http\Resources\ApplicantCollection;
use App\Models\Applicant;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ReportingController extends Controller
{
    public function index(Request $request){
        return Inertia::render('Reporting/Index', [
            'applications' => new ApplicantCollection(
                Applicant::where('vacancy_id', '9b952c8d-d123-4daa-8a23-a78077b549f5')->paginate(5)
            )
        ]);
    }
}
