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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->string('user_type')->default('candidate')->comment('candidate/admin/employer');
            $table->integer('current_step')->default(0);
            $table->rememberToken();
            $table->text('profile_photo_path')->nullable();

            //social login details
            $table->string('provider_id')->nullable();
            $table->string('provider')->nullable();

            $table->boolean('status')->default(false);
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
