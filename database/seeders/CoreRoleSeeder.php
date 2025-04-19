<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class CoreRoleSeeder extends Seeder
{
    public function run(): void
    {
        $roles = ['admin', 'finance', 'support', 'commercial', 'shared'];

        foreach ($roles as $roleName) {
            Role::firstOrCreate(['name' => $roleName]);

            // Create a user for this role
            $user = User::firstOrCreate(
                ['email' => "{$roleName}@tsms.test"],
                [
                    'name' => ucfirst($roleName) . ' User',
                    'password' => Hash::make('password123'),
                ]
            );

            $user->assignRole($roleName);
        }
    }
}

