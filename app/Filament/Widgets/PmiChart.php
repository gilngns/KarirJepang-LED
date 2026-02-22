<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\PmiDeparture;
use Illuminate\Support\Facades\DB;

class PmiChart extends ChartWidget
{
    protected ?string $heading = 'Jumlah Keberangkatan PMI';

    protected int|string|array $columnSpan = [
        'md' => 1,
    ];

    protected function getData(): array
    {
        $data = PmiDeparture::query()
            ->selectRaw('YEAR(date) as year, visa_id, SUM(CAST(total AS UNSIGNED)) as total')
            ->groupBy('year', 'visa_id')
            ->orderBy('year')
            ->get()
            ->groupBy('year');

        $years = $data->keys()->toArray();

        $tokuteiData = [];
        $gijinkokuData = [];

        foreach ($years as $year) {
            $records = $data[$year];

            $tokutei = $records->firstWhere('visa.name', 'Tokutei Ginou');
            $gijinkoku = $records->firstWhere('visa.name', 'Gijinkoku');

            $tokuteiData[] = $tokutei ? (int) $tokutei->total : 0;
            $gijinkokuData[] = $gijinkoku ? (int) $gijinkoku->total : 0;
        }

        return [
            'datasets' => [
                [
                    'label' => 'Tokutei Ginou',
                    'data' => $tokuteiData,
                    'backgroundColor' => '#ef4444',
                ],
                [
                    'label' => 'Gijinkoku',
                    'data' => $gijinkokuData,
                    'backgroundColor' => '#3b82f6',
                ],
            ],
            'labels' => $years,
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
