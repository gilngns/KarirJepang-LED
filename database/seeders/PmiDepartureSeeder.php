<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PmiDeparture;
use App\Models\Visa;
use Carbon\Carbon;

class PmiDepartureSeeder extends Seeder
{
    public function run(): void
    {
        $tokutei = Visa::where('name', 'Tokutei Ginou')->first();
        $gijinkoku = Visa::where('name', 'Gijinkoku')->first();

        $data = [
            ['date' => '2022-01-01', 'tokutei' => '250', 'gijinkoku' => '10'],
            ['date' => '2023-01-01', 'tokutei' => '315', 'gijinkoku' => '9'],
            ['date' => '2024-01-01', 'tokutei' => '285', 'gijinkoku' => '11'],
            ['date' => '2025-01-01', 'tokutei' => '415', 'gijinkoku' => '8'],
            ['date' => '2026-01-01', 'tokutei' => '10', 'gijinkoku' => '2'],
        ];

        foreach ($data as $row) {
            PmiDeparture::create([
                'date' => $row['date'],
                'visa_id' => $tokutei->id,
                'total' => $row['tokutei'],
            ]);

            PmiDeparture::create([
                'date' => $row['date'],
                'visa_id' => $gijinkoku->id,
                'total' => $row['gijinkoku'],
            ]);
        }
    }
}
