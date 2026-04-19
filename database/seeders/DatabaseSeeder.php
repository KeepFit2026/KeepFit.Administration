<?php

namespace Database\Seeders;

use App\Models\Login;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $admin = Login::factory()->create();
        $prof = Login::create([
            'email' => 'prof@gmail.com',
            'password' => Hash::make('password')
        ]);
        $adminRole = Role::create(['name' => 'admin']);
        $profRole = Role::create(['name' => 'teacher']);

        Role::create(['name' => 'user']);

        $admin->assignRole($adminRole);
        $prof->assignRole($profRole);
    }
}
