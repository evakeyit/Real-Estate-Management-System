<?php

namespace Database\Seeders;

use App\Models\Client;
use App\Models\Property;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::query()->firstOrCreate(
            ['username' => 'admin'],
            ['password' => Hash::make('password123')]
        );

        $properties = Property::factory()->count(5)->create();
        $clients = Client::factory()->count(5)->create();

        foreach (range(1, 8) as $i) {
            Transaction::create([
                'client_id' => $clients->random()->client_id,
                'property_id' => $properties->random()->property_id,
                'date' => now()->subDays(rand(1, 90))->toDateString(),
            ]);
        }
    }
}
