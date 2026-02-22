<?php

namespace Database\Seeders;

use App\Models\Division;
use App\Models\StaffProfile;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);

        $marketing = Division::firstOrCreate(['name' => 'Marketing']);
        $officer   = Division::firstOrCreate(['name' => 'Officer']);
        $it        = Division::firstOrCreate(['name' => 'IT']);

        $radit = User::create([
            'name' => 'Radit',
            'email' => 'radit@gmail.com',
            'password' => bcrypt('password'),
            'role' => 'staff',
        ]);

        StaffProfile::create([
            'user_id' => $radit->id,
            'division_id' => $marketing->id,
            'position' => 'Marketing Staff',
        ]);

        $haikal = User::create([
            'name' => 'Haikal',
            'email' => 'haikal@gmail.com',
            'password' => bcrypt('password'),
            'role' => 'staff',
        ]);

        StaffProfile::create([
            'user_id' => $haikal->id,
            'division_id' => $officer->id,
            'position' => 'Officer',
        ]);

        $andika = User::create([
            'name' => 'Andika',
            'email' => 'andika@gmail.com',
            'password' => bcrypt('password'),
            'role' => 'staff',
        ]);

        StaffProfile::create([
            'user_id' => $andika->id,
            'division_id' => $it->id,
            'position' => 'IT Support',
        ]);
    }
}
