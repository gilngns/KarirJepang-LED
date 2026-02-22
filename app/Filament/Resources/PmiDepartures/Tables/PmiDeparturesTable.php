<?php

namespace App\Filament\Resources\PmiDepartures\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Visa;

class PmiDeparturesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('date')
                    ->date()
                    ->sortable(),
                TextColumn::make('visa.name')
                    ->badge()
                    ->sortable()
                    ->searchable(),
                TextColumn::make('total')
                    ->sortable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
            SelectFilter::make('visa_id')
                ->label('Filter Jenis Visa')
                ->options(Visa::pluck('name', 'id')->toArray()),

            SelectFilter::make('year')
                ->label('Filter Tahun')
                ->options(function () {
                    return \App\Models\PmiDeparture::query()
                        ->selectRaw('YEAR(date) as year')
                        ->distinct()
                        ->orderBy('year', 'desc')
                        ->pluck('year', 'year')
                        ->toArray();
                })
                ->query(function (Builder $query, array $data) {
                    if (! empty($data['value'])) {
                        $query->whereYear('date', $data['value']);
                    }
                }),
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
