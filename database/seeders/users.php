<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class users extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Elizabeth Plato',
            'email' => 'eli.plato@santuario.com',
            'password' => 'santuario123',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
