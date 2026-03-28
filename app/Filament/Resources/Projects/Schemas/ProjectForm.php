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
                    ->image()
                    ->disk('public')
                    ->directory('projects')
                    ->visibility('public')
                    ->afterStateHydrated(function ($component, $state) {
                        if ($state && !str_starts_with($state, 'projects/')) {
                            $component->state('projects/' . $state);
                        }
                    })
                    ->getUploadedFileNameForStorageUsing(function (\Livewire\Features\SupportFileUploads\TemporaryUploadedFile $file, $get): string {
                        $title = $get('title') ?? 'project';
                        $slug = \Illuminate\Support\Str::slug($title);
                        return (string) str($slug)
                            ->append('-')
                            ->append(now()->timestamp)
                            ->append('.')
                            ->append($file->getClientOriginalExtension());
                    }),
                Textarea::make('description')
                    ->columnSpanFull(),
            ]);
    }
}
