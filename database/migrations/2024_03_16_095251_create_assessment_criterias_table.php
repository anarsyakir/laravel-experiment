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
        Schema::create('assessment_criterias', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('vacancy_assessment_id')->index();
            $table->foreign('vacancy_assessment_id')->references('id')->on('vacancy_assessments');
            $table->uuid('criteria_id')->index();
            $table->foreign('criteria_id')->references('id')->on('criterias');
            $table->integer('treshold');
            $table->integer('weight');
            $table->boolean('publish');
            $table->json('reference')->nullable();
            $table->json('additional')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assessment_criterias');
    }
};
