<?php

namespace Database\Seeders;

use App\Models\Login;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Login::factory(1)->create();

        // User::factory()->create([
        //     'name' => 'Admin',
        //     'email' => 'blondeau.mathis@orange.fr',
        //     'password' => Hash::make('password'),
        // ]);
    }
}
