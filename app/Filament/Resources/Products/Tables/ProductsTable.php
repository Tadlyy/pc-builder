<?php

namespace App\Filament\Resources\Products\Tables;

use App\Models\Product;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;

class ProductsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('category.name')
                    ->label('Kategorie')
                    ->searchable(),
                TextColumn::make('price')
                    ->label('Preis')
                    ->money('CHF')
                    ->sortable(),
                IconColumn::make('in_stock')
                    ->label('Lager')
                    ->boolean(),
                TextColumn::make('url')
                    ->label('Digitec')
                    ->url(fn (Product $record): ?string => $record->url, true)
                    ->placeholder('—'),
            ])
            ->filters([
                SelectFilter::make('category_id')
                    ->label('Kategorie')
                    ->relationship('category', 'name'),
                TernaryFilter::make('in_stock')
                    ->label('Auf Lager'),
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
}
