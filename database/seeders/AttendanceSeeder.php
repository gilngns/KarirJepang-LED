<?php

namespace Database\Seeders;

use App\Models\Attendance;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AttendanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $staff = User::where('role', 'staff')->first();

        Attendance::create([
            'user_id' => $staff->id,
            'date' => now(),
            'status' => 'Hadir',
            'note' => 'On time',
        ]);
    }
}
