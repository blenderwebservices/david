<?php

namespace App\Filament\Resources\AiProviders;

use App\Filament\Resources\AiProviders\Pages\ManageAiProviders;
use App\Models\AiProvider;
use BackedEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class AiProviderResource extends Resource
{
    protected static ?string $model = AiProvider::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                Select::make('ai_vendor_id')
                    ->relationship('vendor', 'name')
                    ->required()
                    ->reactive()
                    ->afterStateUpdated(fn ($set) => $set('ai_model_id', null)),
                Select::make('ai_model_id')
                    ->relationship('aiModel', 'name', fn ($query, $get) => $query->where('ai_vendor_id', $get('ai_vendor_id')))
                    ->nullable(),
                TextInput::make('api_key')
                    ->password()
                    ->revealable(),
                TextInput::make('base_url')
                    ->url()
                    ->placeholder('https://api.openai.com/v1'),
                Toggle::make('is_default')
                    ->required(),
                Toggle::make('web_search_enabled')
                    ->required(),
                Textarea::make('system_prompt')
                    ->columnSpanFull()
                    ->rows(5),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                TextColumn::make('name')
                    ->searchable(),
                TextColumn::make('vendor.name')
                    ->sortable(),
                TextColumn::make('aiModel.name')
                    ->searchable(),
                TextColumn::make('api_key')
                    ->searchable(),
                TextColumn::make('base_url')
                    ->searchable(),
                IconColumn::make('is_default')
                    ->boolean(),
                IconColumn::make('web_search_enabled')
                    ->boolean(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ManageAiProviders::route('/'),
        ];
    }
}
