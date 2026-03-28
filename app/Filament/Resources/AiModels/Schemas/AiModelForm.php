<?php

namespace App\Filament\Resources\AiModels\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class AiModelForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('ai_vendor_id')
                    ->relationship('aiVendor', 'name')
                    ->required(),
                TextInput::make('name')
                    ->required(),
                TextInput::make('key')
                    ->required(),
                TextInput::make('model_key')
                    ->required(),
            ]);
    }
}
