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
        Schema::create('user_education', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('user_id')->index();
            $table->foreign('user_id')->references('id')->on('users');
            $table->uuid('education_id')->index();
            $table->foreign('education_id')->references('id')->on('education');
            $table->uuid('major_id')->index();
            $table->foreign('major_id')->references('id')->on('majors');
            $table->string('school');
            $table->string('gpa');
            $table->year('year');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_education');
    }
};
