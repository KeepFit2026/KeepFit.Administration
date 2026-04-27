<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('difficulties', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->timestamps();
        });

        // Valeur par défaut dans la table difficulties
        DB::table('difficulties')->insert([
            ['id' => Str::uuid(), 'name' => 'Débutant', 'created_at' => now(), 'updated_at' => now()],
            ['id' => Str::uuid(), 'name' => 'Intermédiaire', 'created_at' => now(), 'updated_at' => now()],
            ['id' => Str::uuid(), 'name' => 'Expert', 'created_at' => now(), 'updated_at' => now()],
        ]);

        Schema::table('exercises', function(Blueprint $table) {
            $table->foreignUuid('difficulty_id')->constrained('difficulties');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('exercises', function (Blueprint $table) {
            $table->dropForeign(['difficulty_id']);
            $table->dropColumn('difficulty_id');
        });
        Schema::dropIfExists('difficulties');
    }
};
