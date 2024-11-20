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
        Schema::create('coordinator_program_stage', function (Blueprint $table) {
            $table->id();
            $table->foreignId(column: 'coordinator_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId(column: 'program_stage_id')->constrained('program_stages')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coordinator_program_stage');
    }
};
