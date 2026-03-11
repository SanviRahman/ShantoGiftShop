<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::firstOrCreate(
            ['email' => 'admin@shantogiftshop.com'],
            [
                'name' => 'Super Admin',
                'phone' => '01900000000',
                'usertype' => 'admin',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
            ]
        );

        // Ensure usertype is admin even if user existed
        if ($admin->usertype !== 'admin') {
            $admin->update(['usertype' => 'admin']);
        }

        $this->command->info('Admin user created/updated successfully.');
        $this->command->info('Email: admin@shantogiftshop.com');
        $this->command->info('Password: password');
    }
}
