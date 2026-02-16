<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\PmiDeparture;

class PmiChart extends ChartWidget
{
    protected ?string $heading = 'Jumlah Keberangkatan PMI';

    protected function getData(): array
    {
        $years = PmiDeparture::query()
            ->select('year')
            ->distinct()
            ->orderBy('year')
            ->pluck('year');

        $tokuteiData = [];
        $gijinkokuData = [];

        foreach ($years as $year) {
            $tokuteiData[] = PmiDeparture::where('year', $year)
                ->whereHas('visa', fn($q) => $q->where('name', 'Tokutei Ginou'))
                ->value('total') ?? 0;

            $gijinkokuData[] = PmiDeparture::where('year', $year)
                ->whereHas('visa', fn($q) => $q->where('name', 'Gijinkoku'))
                ->value('total') ?? 0;
        }

        return [
            'datasets' => [
                [
                    'label' => 'Tokutei Ginou',
                    'data' => $tokuteiData,
                    'backgroundColor' => 'red',
                ],
                [
                    'label' => 'Gijinkoku',
                    'data' => $gijinkokuData,
                    'backgroundColor' => 'blue',
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
