<?php

namespace App\Filament\Resources\AiVendors\Pages;

use App\Filament\Resources\AiVendors\AiVendorResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditAiVendor extends EditRecord
{
    protected static string $resource = AiVendorResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
