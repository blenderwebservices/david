<?php

namespace App\Filament\Resources\AiVendors\Pages;

use App\Filament\Resources\AiVendors\AiVendorResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListAiVendors extends ListRecords
{
    protected static string $resource = AiVendorResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
