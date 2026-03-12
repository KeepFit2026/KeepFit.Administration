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
        Schema::create('classrooms', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::table('users', function(Blueprint $table) {
            $table->foreignUuid('classroom_id')
                ->nullable()
                ->constrained('classrooms');
            });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['classroom_id']);
            $table->dropColumn('classroom_id');
        });
        Schema::dropIfExists('classrooms');
    }
};
