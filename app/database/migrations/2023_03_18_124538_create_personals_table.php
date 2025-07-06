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
        Schema::create('personals', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->boolean('name_status')->default(false);
            $table->string('email')->nullable();
            $table->boolean('email_status')->default(false);
            $table->string('phone')->nullable();
            $table->boolean('phone_status')->default(false);
            $table->string('current_title')->nullable();
            $table->boolean('current_title_status')->default(true);
            $table->string('zip_code')->nullable();
            $table->boolean('zip_code_status')->default(false);
            $table->string('linkedin_url')->nullable();
            $table->boolean('linkedin_url_status')->default(true);
            $table->string('additional_url')->nullable();
            $table->string('additional_url_status')->default(true);

            //position preferences
            $table->string('salary_range')->nullable();
            $table->boolean('work_environment_remote')->default(false);
            $table->boolean('work_environment_in_office')->default(false);
            $table->boolean('work_environment_hybrid')->default(false);
            $table->boolean('schedule_full_time')->default(false);
            $table->boolean('schedule_part_time')->default(false);
            $table->boolean('schedule_no_preference')->default(false);
            $table->boolean('compensation_salary')->default(false);
            $table->boolean('compensation_hourly')->default(false);
            $table->boolean('compensation_comission_based')->default(false);
            $table->boolean('prefered_benefits_insurance_benefits')->default(false);
            $table->boolean('prefered_benefits_padi_holidays')->default(false);
            $table->boolean('prefered_benefits_paid_vacation_days')->default(false);
            $table->boolean('prefered_benefits_professional_environment')->default(false);
            $table->boolean('prefered_benefits_casual_environment')->default(false);

            //distance
            $table->string('distance')->nullable();

            //resume path
            $table->string('resume')->nullable();

            //more about me
            $table->string('short_bio')->nullable();
            $table->string('short_bio_status')->default(false);

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
        Schema::dropIfExists('personals');
    }
};
