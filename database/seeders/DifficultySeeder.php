<?php

namespace Database\Seeders;

use App\Models\Difficulty;
use Illuminate\Database\Seeder;

class DifficultySeeder extends Seeder
{
    public function run(): void
    {
        Difficulty::create(['name' => 'Facile']);
        Difficulty::create(['name' => 'Moyen']);
        Difficulty::create(['name' => 'Difficile']);
    }
}