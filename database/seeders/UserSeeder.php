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
        User::factory()->count(10)->create();
    }
}
