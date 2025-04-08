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
        Schema::create('tenants', function (Blueprint $table) {
            $table->id();
            $table->foreignId('system_id')->constrained();
            $table->foreignId('owner_id')->constrained('users');
            $table->string('name');
            $table->string('subdomain')->unique();
            $table->string('database_name')->unique();
            $table->json('configuration')->nullable();
            $table->enum('status', ['active', 'pending', 'suspended'])->default('pending');
            $table->timestamp('expires_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tenants');
    }
};
