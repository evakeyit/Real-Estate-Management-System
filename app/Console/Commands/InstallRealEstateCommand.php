<?php

namespace App\Console\Commands;

use App\Services\DatabaseBootstrap;
use Illuminate\Console\Command;

class InstallRealEstateCommand extends Command
{
    protected $signature = 'realestate:install {--fresh : Drop all tables and re-run migrations}';

    protected $description = 'Create realestate_db database, run migrations, and seed demo data';

    public function handle(): int
    {
        $this->info('Creating database if it does not exist...');
        DatabaseBootstrap::ensureDatabaseExists();

        if ($this->option('fresh')) {
            $this->call('migrate:fresh', ['--force' => true, '--seed' => true]);
        } else {
            $this->call('migrate', ['--force' => true]);
            $this->call('db:seed', ['--force' => true]);
        }

        $this->newLine();
        $this->info('Installation complete!');
        $this->line('Login: admin / password123');
        $this->line('Run: php artisan serve');
        $this->line('Then: npm run dev (in another terminal for assets)');

        return self::SUCCESS;
    }
}
