<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string(column: 'name');
            $table->string(column: 'colour')->nullable();
            $table->foreignId(column: 'cover_image_id')->nullable()->constrained()->cascadeOnDelete();
            $table->string('logo')->nullable();
            $table->foreignId('contact_person_id')->nullable()->constrained('users', 'id')->cascadeOnDelete();
            $table->string('phone');
            $table->string('email');
            $table->foreignId('province_id')->constrained()->cascadeOnDelete();
            $table->foreignId('sales_person_id')->constrained('users', 'id')->cascadeOnDelete();
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
