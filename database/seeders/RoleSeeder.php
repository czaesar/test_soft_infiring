<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::firstOrCreate(['id' => 1], ['name' => 'admin']);
        Role::firstOrCreate(['id' => 2], ['name' => 'user']);
    }
}
