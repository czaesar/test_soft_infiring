<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::beginTransaction();

        try {
            $admin = User::firstOrCreate(
                ['email' => 'admin@example.com'],
                [
                    'name' => 'Admin User',
                    'password' => Hash::make('password'),
                    'role_id' => 1,
                ]
            );

            $admin->createToken('Laravel Password Grant Client')->accessToken;

            $user = User::firstOrCreate(
                ['email' => 'user@example.com'],
                [
                    'name' => 'Regular User',
                    'password' => Hash::make('password'),
                    'role_id' => 2,
                ]
            );

            $user->createToken('Laravel Password Grant Client')->accessToken;

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();

            Log::error('User seeding failed: '.$e->getMessage());
        }
    }
}
