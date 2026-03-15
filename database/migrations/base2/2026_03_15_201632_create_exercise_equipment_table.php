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
        Schema::create('exercise_equipments', function (Blueprint $table) {
            $table->foreignUuid('exercise_id')->constrained('exercises')->cascadeOnDelete();
            $table->foreignUuid('equipment_id')->constrained('equipments')->cascadeOnDelete();
            $table->primary(['exercise_id', 'equipment_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exercise_equipments');
    }
};
