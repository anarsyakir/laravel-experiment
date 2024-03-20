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
        Schema::create('vacancy_assessments', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('vacancy_id')->index();
            $table->foreign('vacancy_id')->references('id')->on('vacancies');
            $table->uuid('assessment_id')->index();
            $table->foreign('assessment_id')->references('id')->on('assessments');
            $table->integer('sequence');
            $table->integer('treshold');
            $table->integer('weight');
            $table->boolean('count_by_average');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vacancy_assessments');
    }
};
