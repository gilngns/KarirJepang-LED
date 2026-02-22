<?php

namespace App\Filament\Resources\DivisionReports\Tables;

use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class DivisionReportsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('division.name')
                    ->label('Divisi')
                    ->searchable(),

                TextColumn::make('user.name')
                    ->label('Staff')
                    ->searchable(),

                TextColumn::make('job_description')
                    ->label('Deskripsi')
                    ->limit(50),

                TextColumn::make('progress_percentage')
                    ->label('Progress')
                    ->suffix('%')
                    ->badge()
                    ->color(
                        fn($state) =>
                        $state == 100 ? 'success'
                            : ($state >= 75 ? 'primary'
                                : ($state >= 50 ? 'warning'
                                    : 'danger'))
                    )
                    ->sortable(),

                TextColumn::make('report_date')
                    ->label('Tanggal')
                    ->date()
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('division_id')
                    ->label('Filter Divisi')
                    ->relationship('division', 'name'),
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                DeleteBulkAction::make()
                    ->visible(fn() => auth()->user()->isAdmin()),
            ]);
    }
}
