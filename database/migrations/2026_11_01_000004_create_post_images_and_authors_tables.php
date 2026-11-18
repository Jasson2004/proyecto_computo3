<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        // Galería de evidencias individuales por actividad
        Schema::create('post_images', function (Blueprint $table) {
            $table->id();
            $table->foreignId('post_id')->constrained()->cascadeOnDelete();
            $table->string('image_path');
            $table->string('participant_name', 120); // Integrante que acredita evidencia
            $table->enum('evidence_type', ['fotografia', 'constancia', 'asistencia'])->default('fotografia');
            $table->string('caption', 255)->nullable();
            $table->timestamps();
        });

        // Relación muchos a muchos para autores de la pareja
        Schema::create('post_user', function (Blueprint $table) {
            $table->id();
            $table->foreignId('post_id')->constrained()->cascadeOnDelete();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->unique(['post_id', 'user_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('post_user');
        Schema::dropIfExists('post_images');
    }
};