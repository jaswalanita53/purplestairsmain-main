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
        Schema::create('employments', function (Blueprint $table) {
            $table->id();

            $table->string('company_name')->nullable();
            $table->boolean('company_name_status')->default(false);
            $table->string('position')->nullable();
            $table->boolean('position_status')->default(false);
            $table->string('responsibilities')->nullable();
            $table->boolean('responsibilities_status')->default(false);
            $table->string('start_year')->nullable();
            $table->string('end_year')->nullable();
            $table->boolean('start_year_status')->default(false);
            $table->string('accomplishments')->nullable();
            $table->boolean('accomplishments_status')->default(false);

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
        Schema::dropIfExists('employments');
    }
};
