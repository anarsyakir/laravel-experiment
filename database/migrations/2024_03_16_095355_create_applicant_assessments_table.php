<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('applicant_assessments', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('applicant_id')->index();
            $table->foreign('applicant_id')->references('id')->on('applicants');
            $table->uuid('assessment_criteria_id')->index();
            $table->foreign('assessment_criteria_id')->references('id')->on('assessment_criterias');
            $table->integer('result')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('applicant_assessments');
    }
};
