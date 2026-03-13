<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

      User::create([
            'name' => 'Chef Admin',
            'email' => 'admin@cuisine.com',
            'password' => Hash::make('password123'),
            'role' => 'admin',
        ]);

         User::create([
            'name' => 'Lecteur Gourmand',
            'email' => 'gourmand@cuisine.com',
            'password' => Hash::make('password123'),
            'role' => 'gourmand',
        ]);

    }
}
