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
        Schema::create('disease_reports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('health_center_id')->nullable()->constrained('health_centers')->onDelete('set null');
            $table->string('disease_name'); // Nama penyakit
            $table->date('symptom_start_date'); // Tanggal mulai gejala
            $table->text('symptoms'); // Deskripsi gejala
            $table->string('severity')->default('mild'); // mild, moderate, severe
            $table->text('location_description'); // Deskripsi lokasi (untuk monitoring areal)
            $table->decimal('latitude', 10, 8)->nullable();
            $table->decimal('longitude', 11, 8)->nullable();
            $table->enum('status', ['reported', 'being_monitored', 'resolved', 'escalated'])->default('reported');
            $table->text('medical_assessment')->nullable(); // Penilaian medis
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('disease_reports');
    }
};
