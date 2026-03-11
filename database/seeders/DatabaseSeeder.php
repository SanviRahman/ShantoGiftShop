<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            CategorySeeder::class,
            ProductSeeder::class,
        ]);

        $user = User::firstOrCreate(
            ['email' => 'customer@example.com'],
            [
                'name' => 'Demo Customer',
                'phone' => '01700000000',
                'password' => Hash::make('password'), // 'password',
            ]
        );

        $user->profile()->updateOrCreate(
            ['user_id' => $user->id],
            [
                'first_name' => 'Demo',
                'last_name' => 'Customer',
                'phone' => '01700000000',
                'address' => 'Dhaka',
                'city' => 'Dhaka',
                'postal_code' => '1207',
                'country' => 'Bangladesh',
            ]
        );
    }
}
