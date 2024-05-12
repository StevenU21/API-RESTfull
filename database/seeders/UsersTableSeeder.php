<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::factory()->create([
            'name' => 'test',
            'email' => 'user@test.com',
            'password' => bcrypt('test123')
        ]);

        $token = $user->createToken('test')->plainTextToken;
    }
}
