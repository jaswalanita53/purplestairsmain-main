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
        Schema::create('educations', function (Blueprint $table) {
            $table->id();

            $table->string('program_name')->nullable();
            $table->boolean('program_name_status')->default(false);
            $table->string('organization_name')->nullable();
            $table->boolean('organization_name_status')->default(false);
            $table->string('course_description')->nullable();
            $table->boolean('course_description_status')->default(false);
            $table->string('start_year')->nullable();
            $table->string('end_year')->nullable();
            $table->boolean('start_year_status')->default(false);
            $table->unsignedBigInteger('user_id')->index();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('educations');
    }
};
