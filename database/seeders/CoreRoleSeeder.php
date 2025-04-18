<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

use App\Models\User;

class CoreRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run() {
        $roles = ['admin', 'finance','commercial', 'support', 'vendor', 'viewer'];
        foreach ($roles as $role) {
          Role::firstOrCreate(['name' => $role]);
        }
      
        // Optionally assign admin role to first user
        $user = User::first();
        if ($user && !$user->hasRole('admin')) {
          $user->assignRole('admin');
        }
      }
}
