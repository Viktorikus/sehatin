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
        Schema::create('health_services', function (Blueprint $table) {
            $table->id();
            $table->foreignId('health_center_id')->constrained('health_centers')->onDelete('cascade');
            $table->string('name'); // Nama layanan (Pemeriksaan Umum, Imunisasi, dll)
            $table->text('description');
            $table->decimal('price', 10, 2);
            $table->integer('estimated_duration'); // Durasi dalam menit
            $table->integer('quota_per_day')->default(20); // Kuota per hari
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('health_services');
    }
};
