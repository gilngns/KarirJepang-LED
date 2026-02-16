<?php

namespace Database\Seeders;

use App\Models\Visa;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VisaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Visa::insert([
            ['name' => 'Tokutei Ginou', 'color' => 'red'],
            ['name' => 'Gijinkoku', 'color' => 'blue'],
        ]);
    }
}
