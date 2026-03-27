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
                TextInput::make('api_key'),
            ]);
    }
}
