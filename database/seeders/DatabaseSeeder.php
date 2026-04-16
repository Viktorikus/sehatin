<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create test user
        \App\Models\User::factory()->create([
            'name' => 'John Doe',
            'email' => 'user@example.com',
            'role' => 'user',
        ]);

        // Run seeders
        $this->call([
            HealthCenterSeeder::class,
        ]);
    }
}
