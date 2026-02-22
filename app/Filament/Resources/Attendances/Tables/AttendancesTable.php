<?php

namespace App\Filament\Resources\Attendances\Tables;

use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Forms\Components\DatePicker;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Illuminate\Database\Eloquent\Builder;

class AttendancesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->defaultSort('date', 'desc')

            ->columns([
                TextColumn::make('user.name')
                    ->label('Nama Staff')
                    ->searchable(),

                TextColumn::make('date')
                    ->label('Tanggal')
                    ->date()
                    ->sortable(),

                TextColumn::make('status')
                    ->label('Status')
                    ->badge(),

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

                Filter::make('today')
                    ->label('Hari Ini')
                    ->query(
                        fn(Builder $query) =>
                        $query->whereDate('date', now())
                    )
                    ->visible(fn() => auth()->user()->isAdmin()),

                Filter::make('date')
                    ->form([
                        DatePicker::make('date')
                            ->label('Pilih Tanggal'),
                    ])
                    ->query(function (Builder $query, array $data) {
                        return $query
                            ->when(
                                $data['date'] ?? null,
                                fn(Builder $query, $date) =>
                                $query->whereDate('date', $date)
                            );
                    })
                    ->visible(fn() => auth()->user()->isAdmin()),

                SelectFilter::make('user_id')
                    ->label('Staff')
                    ->relationship('user', 'name')
                    ->visible(fn() => auth()->user()->isAdmin()),
            ])

            ->recordActions([
                EditAction::make()
                    ->visible(fn() => auth()->user()->isAdmin()),
            ])

            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make()
                        ->visible(fn() => auth()->user()->isAdmin()),
                ]),
            ]);
    }
}
