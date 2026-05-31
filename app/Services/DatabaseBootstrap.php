<?php

namespace App\Services;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use PDO;
use PDOException;

class DatabaseBootstrap
{
    public static function ensureDatabaseExists(): void
    {
        if (config('database.default') !== 'mysql') {
            return;
        }

        $database = config('database.connections.mysql.database');
        $host = config('database.connections.mysql.host');
        $port = config('database.connections.mysql.port');
        $username = config('database.connections.mysql.username');
        $password = config('database.connections.mysql.password');

        try {
            $dsn = "mysql:host={$host};port={$port};charset=utf8mb4";
            $pdo = new PDO($dsn, $username, $password, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            ]);
            $pdo->exec(
                "CREATE DATABASE IF NOT EXISTS `{$database}` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci"
            );
        } catch (PDOException $e) {
            report($e);
        }
    }

    public static function runMigrationsIfNeeded(): void
    {
        try {
            DB::connection()->getPdo();
        } catch (\Throwable $e) {
            return;
        }

        if (! DB::getSchemaBuilder()->hasTable('users')) {
            Artisan::call('migrate', ['--force' => true]);
            if (class_exists(\Database\Seeders\DatabaseSeeder::class)) {
                Artisan::call('db:seed', ['--force' => true]);
            }
        }
    }
}
