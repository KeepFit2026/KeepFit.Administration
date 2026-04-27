<?php
namespace Database\Seeders;

use App\Models\Level;
use App\Models\Login;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Str;

class DatabaseSeeder extends Seeder
{
    private function calculateRequiredXp(int $level): int
    {
        $baseXp = 100;
        return (int) round($baseXp * pow($level, 1.5));
    }

    public function run(): void
    {
        for ($i = 1; $i <= 3; $i++) {
            Level::create([
                'id'          => Str::uuid(),
                'number'      => $i,
                'required_xp' => $this->calculateRequiredXp($i),
            ]);
        }

        $adminRole   = Role::firstOrCreate(['name' => 'admin']);
        $teacherRole = Role::firstOrCreate(['name' => 'teacher']);
        $userRole    = Role::firstOrCreate(['name' => 'user']);

        // Admin
        $admin = Login::factory()->create([
            'email'    => 'admin@keepfit.fr',
            'password' => Hash::make('password'),
        ]);
        $admin->assignRole($adminRole);

        $prof = Login::factory()->create([
            'email'    => 'martin@keepfit.fr',
            'password' => Hash::make('password'),
            'onboarding_completed' => true,
        ]);

        $prof->assignRole($teacherRole);

        User::on('pgsql_second')->create([
            'account_id' => $prof->id,
            'name'       => 'Mme Martin',
        ]);

        $eleves = [
            ['email' => 'tom@keepfit.fr',     'name' => 'Tom Lefèvre'],
            ['email' => 'sara@keepfit.fr',    'name' => 'Sara A.'],
            ['email' => 'mathieu@keepfit.fr', 'name' => 'Mathieu B.'],
        ];

        foreach ($eleves as $eleve) {
            $login = Login::factory()->create([
                'email'    => $eleve['email'],
                'password' => Hash::make('password'),
                'onboarding_completed' => false
            ]);

            $login->assignRole($userRole);
            User::on('pgsql_second')->create([
                'account_id' => $login->id,
                'name'       => $eleve['name'],
            ]);
        }
    }
}