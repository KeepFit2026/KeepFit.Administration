<?php

namespace Database\Seeders;

use App\Models\Level;
use App\Models\Login;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            DifficultySeeder::class,
            SportQuizSeeder::class
        ]);

        $this->seedLevels();

        $adminRole   = Role::firstOrCreate(['name' => 'admin']);
        $teacherRole = Role::firstOrCreate(['name' => 'teacher']);
        $userRole    = Role::firstOrCreate(['name' => 'user']);

        $defaultLevelId = Level::where('number', 0)->value('id');

        $this->seedAdmin($adminRole, $defaultLevelId);

        $this->seedTeacher($teacherRole, $defaultLevelId);

        $this->seedStudents($userRole, $defaultLevelId);
    }

    /**
     * Génère les niveaux de progression
     */
    private function seedLevels(): void
    {
        $userService = app(UserService::class);

        for ($i = 0; $i <= 3; $i++) {
            Level::updateOrCreate(
                ['number' => $i],
                [
                    'id'          => (string) Str::uuid(),
                    'required_xp' => $i === 0 ? 0 : $userService->calculateRequiredXp($i),
                ]
            );
        }
    }

    /**
     * Génère l'admin système
     */
    private function seedAdmin($role, $levelId): void
    {
        $login = Login::factory()->create([
            'email'    => 'admin@keepfit.fr',
            'password' => Hash::make('password'),
        ]);

        $login->assignRole($role);

        User::create([
            'account_id'    => $login->id,
            'name'          => 'ADMIN',
            'current_level' => $levelId
        ]);
    }

    /**
     * Génère un professeur sur la base pgsql_second
     */
    private function seedTeacher($role, $levelId): void
    {
        $login = Login::factory()->create([
            'email'                => 'martin@keepfit.fr',
            'password'             => Hash::make('password'),
            'onboarding_completed' => true,
        ]);

        $login->assignRole($role);

        User::on('pgsql_second')->create([
            'account_id'    => $login->id,
            'name'          => 'Mme Martin',
            'current_level' => $levelId,
        ]);
    }

    /**
     * Génère la liste des élèves
     */
    private function seedStudents($role, $levelId): void
    {
        $students = [
            ['email' => 'tom@keepfit.fr',     'name' => 'Tom Lefèvre'],
            ['email' => 'sara@keepfit.fr',    'name' => 'Sara A.'],
            ['email' => 'mathieu@keepfit.fr', 'name' => 'Mathieu B.'],
        ];

        foreach ($students as $data) {
            $login = Login::factory()->create([
                'email'                => $data['email'],
                'password'             => Hash::make('password'),
                'onboarding_completed' => false
            ]);

            $login->assignRole($role);

            User::on('pgsql_second')->create([
                'account_id'    => $login->id,
                'name'          => $data['name'],
                'current_level' => $levelId,
            ]);
        }
    }
}