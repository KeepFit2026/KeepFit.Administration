<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class dbReset extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:reset';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('--- Début du Reset des Bases de Données ---');

        // Fresh & Migrate pour la Base 1
        $this->warn('Migration de la Base 1...');
        $this->call('migrate:fresh', [
            '--database' => 'pgsql',
            '--path'     => 'database/migrations/base1',
        ]);

        // 2. Fresh & Migrate pour la Base 2
        $this->warn('Migration de la Base 2...');
        $this->call('migrate:fresh', [
            '--database' => 'pgsql_second', // Le nom de ta deuxième connexion
            '--path'     => 'database/migrations/base2',
        ]);

        $this->warn('Lancement du Seeding...');
        $this->call('db:seed');

        $this->info('--- Toutes les bases ont été réinitialisées avec succès ! ---');

        return Command::SUCCESS;
    }
}
