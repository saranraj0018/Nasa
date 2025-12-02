<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            [
                'id' => 1,
                'name' => 'Super Admin',
                'slug' => 'super_admin',
            ],
            [
                'id' => 2,
                'name' => 'Admin',
                'slug' => 'admin',
            ],
            [
                'id' => 3,
                'name' => 'Teaching Staff',
                'slug' => 'teaching_staff',
            ],
            [
                'id' => 4,
                'name' => 'Non Teaching Staff',
                'slug' => 'non_teaching_staff',
            ]
        ];

        foreach ($roles as $role) {
            $exists = Role::where('slug', $role['slug'])->exists();
            if (! $exists) {
                Role::create($role);
            }
        }
    }
}
