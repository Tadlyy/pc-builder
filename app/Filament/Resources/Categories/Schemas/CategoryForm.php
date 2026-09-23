<?php

namespace App\Filament\Resources\Categories\Schemas;

use Filament\Forms\Components\Get;
use Filament\Forms\Components\Set;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class CategoryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Name')
                    ->required()
                    ->live(onBlur: true)
                    ->afterStateUpdated(function (Set $set, Get $get, ?string $state): void {
                        if (filled($state) && blank($get('slug'))) {
                            $set('slug', Str::slug($state));
                        }
                    }),
                TextInput::make('slug')
                    ->label('Slug')
                    ->unique(ignoreRecord: true)
                    ->helperText('Leer lassen zum automatischen Erzeugen aus dem Namen. Kleinbuchstaben und Bindestriche.')
                    ->regex('/^[a-z0-9-]*$/'),
            ]);
    }
}
