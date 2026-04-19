<?php
namespace Database\Seeders;
use App\Models\Login;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
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