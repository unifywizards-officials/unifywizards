<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $existing = User::where('email', 'admin@gmail.com')->first();

        if ($existing) {
            $this->command->info('Admin user already exists, skipping.');

            return;
        }

        $password = Str::random(16);

        User::create([
            'name' => 'Admin User',
            'email' => 'admin@gmail.com',
            'password' => Hash::make($password),
        ]);

        $this->command->info("Admin user created. Email: admin@gmail.com  Password: {$password}");
        $this->command->warn('Save this password now — it will not be shown again. Change it after first login.');
    }
}
