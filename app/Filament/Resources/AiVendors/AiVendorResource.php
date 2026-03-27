<?php

namespace App\Filament\Resources\AiVendors;

use App\Filament\Resources\AiVendors\Pages\CreateAiVendor;
use App\Filament\Resources\AiVendors\Pages\EditAiVendor;
use App\Filament\Resources\AiVendors\Pages\ListAiVendors;
use App\Filament\Resources\AiVendors\Schemas\AiVendorForm;
use App\Filament\Resources\AiVendors\Tables\AiVendorsTable;
use App\Models\AiVendor;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class AiVendorResource extends Resource
{
    protected static ?string $model = AiVendor::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return AiVendorForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return AiVendorsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListAiVendors::route('/'),
            'create' => CreateAiVendor::route('/create'),
            'edit' => EditAiVendor::route('/{record}/edit'),
        ];
    }
}
