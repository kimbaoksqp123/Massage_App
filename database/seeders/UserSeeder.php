<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::factory()->create([
            'username' => 'admin',
            'email' => 'admin@gmail.com',
            'userType' => '2',
        ]);
        User::factory()->create([
            'username' => 'owner1',
            'email' => 'tuanchibi@gmail.com',
            'userType' => '1',
        ]);
        User::factory()->create([
            'username' => 'user1',
            'email' => 'kimbao@gmail.com',
            'userType' => '1',
        ]);
        User::factory()->count(10)->create();
    }
}
