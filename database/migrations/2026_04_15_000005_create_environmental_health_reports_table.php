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
        Schema::create('environmental_health_reports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('title'); // Judul laporan
            $table->text('description'); // Deskripsi masalah kesehatan lingkungan
            $table->string('category'); // air, sanitasi, sampah, polusi, dll
            $table->string('severity')->default('normal'); // normal, warning, critical
            $table->string('location_address');
            $table->decimal('latitude', 10, 8)->nullable();
            $table->decimal('longitude', 11, 8)->nullable();
            $table->string('image_path')->nullable(); // Foto bukti
            $table->enum('status', ['submitted', 'under_review', 'processing', 'resolved'])->default('submitted');
            $table->text('admin_notes')->nullable(); // Catatan dari admin/pihak berwenang
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('environmental_health_reports');
    }
};
