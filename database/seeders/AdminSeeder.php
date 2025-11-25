<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminRole = Role::where('slug', 'admin')->first();
        $superAdminRole = Role::where('slug', 'super_admin')->first();

        if (! $adminRole) {
            $this->command->error('Admin role not found. Run RoleSeeder first.');
            return;
        }

        if (! $superAdminRole) {
            $this->command->error('Super Admin role not found. Run RoleSeeder first.');
            return;
        }

        // ---- Admin User ----
        if (! Admin::where('email', 'admin@example.com')->exists()) {
            Admin::create([
                'role_id'       => $adminRole->id,
                'name'          => 'Admin',
                'email'         => 'admin@example.com',
                'password'      => Hash::make('123456'),
                'mobile_number' => '9998887777',
                'security_code' => null,
            ]);
        } else {
            $this->command->info('Admin already exists, skipping.');
        }

        // ---- Super Admin User ----
        if (! Admin::where('email', 'superadmin@example.com')->exists()) {
            Admin::create([
                'role_id'       => $superAdminRole->id,
                'name'          => 'Super Admin',
                'email'         => 'superadmin@example.com',
                'password'      => Hash::make('123456'),
                'mobile_number' => '9998887776',
                'security_code' => '123456',
            ]);
        } else {
            $this->command->info('Super Admin already exists, skipping.');
        }
    }
}
