<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                TextInput::make('email')
                    ->label('Email address')
                    ->email()
                    ->required(),
                DateTimePicker::make('email_verified_at'),
                TextInput::make('password')
                    ->password()
                    ->required(),
                \Filament\Forms\Components\Select::make('role')
                    ->options([
                        \App\Models\User::ROLE_ADMIN => 'Administrator',
                        \App\Models\User::ROLE_USER => 'User',
                    ])
                    ->required()
                    ->default(\App\Models\User::ROLE_USER),
            ]);
    }
}
