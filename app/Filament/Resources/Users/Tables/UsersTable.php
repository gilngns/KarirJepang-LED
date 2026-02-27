<?php

namespace App\Filament\Resources\Users\Tables;

use Filament\Actions\DeleteAction as ActionsDeleteAction;
use Filament\Actions\EditAction as ActionsEditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Table;

class UsersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([

                TextColumn::make('name')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('email')
                    ->searchable(),

                BadgeColumn::make('role')
                    ->colors([
                        'success' => 'admin',
                        'gray' => 'staff',
                    ]),

                TextColumn::make('staffProfile.division.name')
                    ->label('Divisi')
                    ->placeholder('-'),

                TextColumn::make('staffProfile.position')
                    ->label('Jabatan')
                    ->placeholder('-'),

                IconColumn::make('is_active')
                    ->label('Status')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle')
                    ->trueColor('success')
                    ->falseColor('danger'),

            ])
            ->actions([

                ActionsEditAction::make(),

                ActionsDeleteAction::make()
                    ->visible(
                        fn($record) =>
                        $record->id !== auth()->id()
                    ),

            ]);
    }
}