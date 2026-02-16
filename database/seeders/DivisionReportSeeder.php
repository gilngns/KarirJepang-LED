<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\DivisionReport;
use App\Models\User;
use App\Models\Division;

class DivisionReportSeeder extends Seeder
{
    public function run(): void
    {
        $staff = User::where('role', 'staff')->first();
        $division = Division::first();

        DivisionReport::insert([
            [
                'division_id' => $division->id,
                'user_id' => $staff->id,
                'job_description' => 'Mengembangkan channel distribusi',
                'progress_percentage' => 70,
                'report_date' => now(),
            ],
            [
                'division_id' => $division->id,
                'user_id' => $staff->id,
                'job_description' => 'Followup event project Digimedia',
                'progress_percentage' => 50,
                'report_date' => now(),
            ],
        ]);
    }
}
