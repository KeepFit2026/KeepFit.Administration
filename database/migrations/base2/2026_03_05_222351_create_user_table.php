<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    protected $connection = 'pgsql_second';
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::connection('pgsql_second')->create('users', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->uuid('account_id');

            //Gamification
            $table->integer('current_xp')->default(0);
            $table->integer('current_level')->default(0);

            //Onboarding
            $table->string('school')->nullable()->comment('Établissement scolaire');
            $table->string('grade')->nullable()->comment('Niveau ou classe');
            $table->string('sports_profile')->nullable()->comment('eps_only, unss, club, section');
            $table->string('primary_goal')->nullable()->comment('exam, competition, decompress, discovery');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::connection('pgsql_second')->dropIfExists('users');
    }
};
