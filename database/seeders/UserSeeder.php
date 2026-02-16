<?php

namespace Database\Seeders;

use App\Models\Division;
use App\Models\StaffProfile;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@mail.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);

        $division = Division::first();

        $staff = User::create([
            'name' => 'Staff 1',
            'email' => 'staff@mail.com',
            'password' => bcrypt('password'),
            'role' => 'staff',
        ]);

        StaffProfile::create([
            'user_id' => $staff->id,
            'division_id' => $division->id,
            'position' => 'Officer',
        ]);
    }
}
