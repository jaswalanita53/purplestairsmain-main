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
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            //contact information
            $table->string('company_name')->nullable();
            $table->string('company_email')->nullable();
            $table->string('company_phone')->nullable();
            $table->string('website_url')->nullable();
            $table->string('social_media_url')->nullable();

            //company info
            $table->string('number_of_employees')->nullable();
            $table->boolean('insurance_benefits')->default(false);
            $table->boolean('paid_holidays')->default(false);
            $table->boolean('paid_vacation_days')->default(false);
            $table->boolean('professional_environment')->default(false);
            $table->boolean('casual_environment')->default(false);
            $table->longText('company_description')->nullable();


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
        Schema::dropIfExists('companies');
    }
};
