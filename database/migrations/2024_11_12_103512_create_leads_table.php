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
        Schema::create('leads', function (Blueprint $table) {
            $table->id();
            $table->string(column: 'title');
            $table->text('description');
            $table->boolean('is_referral')->default(false);
            $table->string('referrer')->nullable();
            $table->double('revenue');
            $table->double('potential_users');
            $table->foreignId('client_id')->constrained();
            $table->foreignId('lead_stage_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');            
            $table->integer('order')->default(value: 0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leads');
    }
};
