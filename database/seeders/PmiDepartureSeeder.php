<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PmiDeparture;
use App\Models\Visa;

class PmiDepartureSeeder extends Seeder
{
    public function run(): void
    {
        $tokutei = Visa::where('name', 'Tokutei Ginou')->first();
        $gijinkoku = Visa::where('name', 'Gijinkoku')->first();

        $data = [
            ['year' => 2022, 'tokutei' => 250, 'gijinkoku' => 10],
            ['year' => 2023, 'tokutei' => 315, 'gijinkoku' => 9],
            ['year' => 2024, 'tokutei' => 285, 'gijinkoku' => 11],
            ['year' => 2025, 'tokutei' => 415, 'gijinkoku' => 8],
            ['year' => 2026, 'tokutei' => 10,  'gijinkoku' => 2],
        ];

        foreach ($data as $row) {
            PmiDeparture::create([
                'year' => $row['year'],
                'visa_id' => $tokutei->id,
                'total' => $row['tokutei'],
            ]);

            PmiDeparture::create([
                'year' => $row['year'],
                'visa_id' => $gijinkoku->id,
                'total' => $row['gijinkoku'],
            ]);
        }
    }
}
