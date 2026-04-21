<?php

namespace App\Filament\Resources\Projects\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class ProjectForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->required(),
                TextInput::make('type')
                    ->default('project'),
                TextInput::make('status')
                    ->default('ongoing'),
                \Filament\Forms\Components\Toggle::make('is_featured'),
                TextInput::make('url')
                    ->url(),
                \Filament\Forms\Components\FileUpload::make('image_path')
                    ->label('Imagen')
                    ->image()
                    ->directory('projects')
                    ->disk('public')
                    ->visibility('public'),
                Textarea::make('description')
                    ->columnSpanFull(),
            ]);
    }
}
