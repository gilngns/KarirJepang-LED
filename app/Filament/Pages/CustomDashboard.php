<?php

namespace App\Filament\Pages;

use App\Models\Attendance;
use App\Models\DivisionReport;
use App\Models\Partner;
use App\Services\GoogleCalendarService;
use Filament\Pages\Page;
use Filament\Support\Enums\Width;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Filters\Filter;

class CustomDashboard extends Page implements HasTable
{
    use InteractsWithTable;

    protected string $view = 'filament.pages.custom-dashboard';

    protected static string $routePath = '/';

    protected static ?string $navigationLabel = 'Dashboard';

    protected static ?string $title = 'Dashboard';

    protected static ?int $navigationSort = -2;

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-home';

    protected Width|string|null $maxContentWidth = \Filament\Support\Enums\Width::SevenExtraLarge;

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Attendance::query()
                    ->with('user')
                    ->whereDate('created_at', today())
            )
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    ->label('Nama Staff')
                    ->searchable(),

                Tables\Columns\BadgeColumn::make('status')
                    ->colors([
                        'success' => 'Hadir',
                        'danger' => 'Sakit',
                        'warning' => 'Cuti',
                    ])
                    ->sortable(),

                Tables\Columns\TextColumn::make('note')
                    ->label('Keterangan')
                    ->limit(40),
            ])
            ->filters([
                Filter::make('today')
                    ->label('Hari Ini')
                    ->query(
                        fn($query) =>
                        $query->whereDate('created_at', today())
                    ),

                Filter::make('date')
                    ->form([
                        \Filament\Forms\Components\DatePicker::make('tanggal'),
                    ])
                    ->query(function ($query, array $data) {
                        if ($data['tanggal']) {
                            $query->whereDate('created_at', $data['tanggal']);
                        }
                    }),
            ])
            ->defaultSort('created_at', 'desc')
            ->paginated([5, 10, 20]);
    }

    public function getViewData(): array
    {
        return [
            'totalHadir' => Attendance::where('status', 'Hadir')->count(),
            'totalSakit' => Attendance::where('status', 'Sakit')->count(),
            'totalCuti'  => Attendance::where('status', 'Cuti')->count(),
        ];
    }

    public function getMeetings()
    {
        return app(GoogleCalendarService::class)->getTodayEvents();
    }

    public function getLatestDivisionReports()
    {
        return DivisionReport::with(['division'])
            ->latest('report_date')
            ->get()
            ->groupBy('division_id')
            ->map(function ($reports) {
                return $reports->first(); 
            })
            ->values();
    }

    public function getPmiYearlyVisaChart()
    {
        $data = \App\Models\PmiDeparture::query()
            ->selectRaw('YEAR(date) as year, visa_id, SUM(total) as total')
            ->with('visa')
            ->groupBy('year', 'visa_id')
            ->orderBy('year')
            ->get();

        $years = $data->pluck('year')->unique()->sort()->values();

        $visas = \App\Models\Visa::pluck('name', 'id');

        $datasets = [];

        foreach ($visas as $visaId => $visaName) {

            $datasetData = [];

            foreach ($years as $year) {
                $record = $data->first(
                    fn($d) =>
                    $d->year == $year && $d->visa_id == $visaId
                );

                $datasetData[] = $record ? (int) $record->total : 0;
            }

            $datasets[] = [
                'label' => $visaName,
                'data' => $datasetData,
            ];
        }

        return [
            'labels' => $years,
            'datasets' => $datasets,
        ];
    }

    public function getPartners()
    {
        return Partner::orderBy('name')->get();
    }
}