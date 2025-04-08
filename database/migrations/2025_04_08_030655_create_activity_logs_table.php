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
        Schema::create('activity_logs', function (Blueprint $table) {
            $table->id();
            $table->string('log_name')->default('default'); // Nombre del log
            $table->text('description'); // Descripción del log
            $table->foreignId('subject_id')->nullable(); // ID del sujeto relacionado
            $table->string('subject_type')->nullable(); // Tipo del sujeto relacionado
            $table->foreignId('causer_id')->nullable(); // ID del causante
            $table->string('causer_type')->nullable(); // Tipo del causante
            $table->json('properties')->nullable(); // Propiedades adicionales en formato JSON
            $table->timestamps();

            // Índices para mejorar las consultas
            $table->index(['subject_id', 'subject_type'], 'subject');
            $table->index(['causer_id', 'causer_type'], 'causer');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activity_logs');
    }
};
