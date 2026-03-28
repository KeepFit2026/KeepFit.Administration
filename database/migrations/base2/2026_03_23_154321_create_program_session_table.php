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
        Schema::create('program_sessions', function (Blueprint $table) {
            $table->foreignUuid('program_id')->constrained('programs')->cascadeOnDelete();
            $table->foreignUuid('session_id')->constrained('sessions')->cascadeOnDelete();
            $table->primary(['program_id', 'session_id']);
            $table->timestamps();
        });

        Schema::create('exercise_sessions', function (Blueprint $table) {
            $table->foreignUuid('exercise_id')->constrained('exercises')->cascadeOnDelete();
            $table->foreignUuid('session_id')->constrained('sessions')->cascadeOnDelete();
            $table->primary(['exercise_id', 'session_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('program_session');
    }
};
