<?php

namespace Database\Seeders;

use App\Models\Login;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $admin = Login::factory()->create();
        $adminRole = Role::create(['name' => 'admin']);

        Role::create(['name' => 'teacher']);
        Role::create(['name' => 'user']);

        $admin->assignRole($adminRole);
    }
}
