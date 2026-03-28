<?php

namespace App\Filament\Resources\AiVendors\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class AiVendorForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                TextInput::make('key')
                    ->required(),
                TextInput::make('api_key')
                    ->password(),
                TextInput::make('base_url')
                    ->url(),
                \Filament\Forms\Components\Toggle::make('is_active')
                    ->default(true),
            ]);
    }
}
