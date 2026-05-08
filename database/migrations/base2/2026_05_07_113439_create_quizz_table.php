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
        Schema::create('quizzes', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('title');
            $table->text('description')->nullable();
            $table->foreignUuid('difficulty_id')->constrained('difficulties');
            $table->boolean('is_published')->default(false);
            $table->integer('xp_reward')->default(10);
            $table->timestamps();
        });

        Schema::create('questions', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->text('content');
            $table->foreignUuid('difficulty_id')->constrained('difficulties');
            $table->timestamps();
        });

        Schema::create('question_quizzes', function (Blueprint $table) {
            $table->foreignUuid('quizz_id')->constrained('quizzes')->cascadeOnDelete();
            $table->foreignUuid('question_id')->constrained('questions')->cascadeOnDelete();
            $table->primary(['quizz_id', 'question_id']);
        });

        Schema::create('answers', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('question_id')->constrained('questions')->cascadeOnDelete();
            $table->string('content');
            $table->boolean('is_correct')->default(false);
            $table->timestamps();
        });


        Schema::create('daily_quizzes', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->date('scheduled_date')->unique();
            $table->foreignUuid('quizz_id')->constrained('quizzes');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quizzes');
        Schema::dropIfExists('questions');
        Schema::dropIfExists('question_quizzes');
        Schema::dropIfExists('answers');
        Schema::dropIfExists('daily_quizzes');
    }
};
