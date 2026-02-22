<?php

namespace App\Filament\Resources\DivisionReports;

use App\Filament\Resources\DivisionReports\Pages\CreateDivisionReport;
use App\Filament\Resources\DivisionReports\Pages\EditDivisionReport;
use App\Filament\Resources\DivisionReports\Pages\ListDivisionReports;
use App\Filament\Resources\DivisionReports\Schemas\DivisionReportForm;
use App\Filament\Resources\DivisionReports\Tables\DivisionReportsTable;
use App\Models\DivisionReport;
use BackedEnum;
use Illuminate\Database\Eloquent\Builder;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Filament\Navigation\NavigationItem;

class DivisionReportResource extends Resource
{
    protected static ?string $model = DivisionReport::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedDocumentText;

    protected static ?string $recordTitleAttribute = 'job_description';

    public static function form(Schema $schema): Schema
    {
        return DivisionReportForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return DivisionReportsTable::configure($table);
    }

    public static function getEloquentQuery(): Builder
    {
        $query = parent::getEloquentQuery();

        if (request()->has('status')) {
            $query->where('status', request('status'));
        }

        if (auth()->user()->isStaff()) {
            $query->where('user_id', auth()->id());
        }

        return $query;
    }

    public static function getPages(): array
    {
        return [
            'index' => ListDivisionReports::route('/'),
            'create' => CreateDivisionReport::route('/create'),
            'edit' => EditDivisionReport::route('/{record}/edit'),
        ];
    }
}
