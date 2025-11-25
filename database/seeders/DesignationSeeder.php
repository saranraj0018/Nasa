<?php

namespace Database\Seeders;

use App\Models\Designation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DesignationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $designations = [
            ['name' => 'Professor', 'description' => 'Senior faculty member'],
            ['name' => 'Assistant Professor', 'description' => 'Junior faculty member'],
            ['name' => 'Associate Professor', 'description' => 'Intermediate faculty member'],
            ['name' => 'Lecturer', 'description' => 'Teaching faculty member'],
            ['name' => 'Lab Assistant', 'description' => 'Supports laboratory work'],
            ['name' => 'HOD', 'description' => 'Head of Department'],
        ];

        foreach ($designations as $designation) {
            $exists = Designation::where('name', $designation['name'])->exists();
            if (!$exists) {
                $desig = new Designation();
                $desig->name = $designation['name'];
                $desig->description = $designation['description'];
                $desig->save();
            }
        }
    }
}
