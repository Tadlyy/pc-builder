<?php

namespace App\Filament\Resources\Products\Schemas;

use Filament\Forms\Components\CodeEditor;
use Filament\Forms\Components\CodeEditor\Enums\Language;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class ProductForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(2)
            ->components([
                Select::make('category_id')
                    ->label('Kategorie')
                    ->relationship('category', 'name')
                    ->required()
                    ->searchable()
                    ->preload(),
                TextInput::make('price')
                    ->label('Preis (CHF)')
                    ->required()
                    ->numeric()
                    ->prefix('CHF ')
                    ->minValue(0),
                TextInput::make('name')
                    ->label('Produktname')
                    ->required()
                    ->columnSpanFull(),
                Toggle::make('in_stock')
                    ->label('Auf Lager')
                    ->default(true),
                TextInput::make('url')
                    ->label('Digitec-URL')
                    ->url()
                    ->placeholder('https://www.digitec.ch/...')
                    ->columnSpanFull(),
                CodeEditor::make('specs')
                    ->label('Spezifikationen (JSON)')
                    ->language(Language::Json)
                    ->formatStateUsing(fn (?array $state): ?string => is_null($state)
                        ? null
                        : json_encode($state, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE))
                    ->dehydrateStateUsing(function (?string $state): ?array {
                        if (blank($state)) {
                            return null;
                        }

                        $decoded = json_decode($state, true);

                        return is_array($decoded) ? $decoded : null;
                    })
                    ->json()
                    ->helperText('JSON-Objekt mit den Specs dieser Kategorie, z.B. socket, cores, threads, wattage.')
                    ->columnSpanFull(),
            ]);
    }
}
