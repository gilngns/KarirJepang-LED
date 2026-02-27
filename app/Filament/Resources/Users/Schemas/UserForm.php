<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                Section::make('Account Information')
                    ->schema([

                        TextInput::make('name')
                            ->required(),

                        TextInput::make('email')
                            ->email()
                            ->required()
                            ->unique(ignoreRecord: true),

                        TextInput::make('password')
                            ->password()
                            ->revealable()
                            ->dehydrated(fn($state) => filled($state))
                            ->required(
                                fn($livewire) =>
                                $livewire instanceof \App\Filament\Resources\Users\Pages\CreateUser
                            ),

                        Select::make('role')
                            ->options([
                                'admin' => 'Admin',
                                'staff' => 'Staff',
                            ])
                            ->required(),

                        Toggle::make('is_active')
                            ->label('Status Aktif')
                            ->default(true),

                    ])
                    ->columns(2),

                Section::make('Staff Profile')
                    ->relationship('staffProfile')
                    ->schema([

                        Select::make('division_id')
                            ->relationship('division', 'name')
                            ->required(),

                        TextInput::make('position')
                            ->required(),

                    ])
                    ->columns(2),
            ]);
    }
}