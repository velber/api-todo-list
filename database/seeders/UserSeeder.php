<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
        $token = $user->createToken('Bearer Token');

        $this->command->line('Test user has been created: ' . $user->email);
        $this->command->line('Password: password');
        $this->command->line('Bearer Token: ' . $token->plainTextToken);
    }
}
