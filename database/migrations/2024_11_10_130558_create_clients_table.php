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
        Schema::create('clients', function (Blueprint $table) {
            $table->id();  // Remove the extra semicolon here
            $table->foreignId('contact_person_id')->constrained('users', 'id')->onDelete('cascade'); // Contact person references users table
            $table->string('phone');
            $table->string('email')->unique()->nullable(false)->change();
            $table->foreignId('province_id')->constrained()->onDelete('cascade'); // Province references the provinces table
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};
