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
            $table->foreignUuid('session_id')->constrained('sessions');
            $table->foreignUuid('program_id')->constrained('programs');
            $table->primary(['session_id', 'program_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('program_sessions');
    }
};
