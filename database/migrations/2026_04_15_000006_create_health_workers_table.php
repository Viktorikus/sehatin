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
        Schema::create('health_workers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('health_center_id')->constrained('health_centers')->onDelete('cascade');
            $table->string('position'); // dokter, bidan, perawat, dll
            $table->string('specialization')->nullable(); // Spesialisasi jika ada
            $table->string('license_number')->unique();
            $table->text('bio')->nullable();
            $table->string('phone');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('health_workers');
    }
};
