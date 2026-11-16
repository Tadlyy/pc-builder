<?php

namespace App\Filament\Resources\Products\Tables;

use App\Models\Product;
use App\Services\DigitecSyncService;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Notifications\Notification;
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
                Action::make('syncDigitec')
                    ->label('Mit Digitec abgleichen')
                    ->icon('heroicon-o-arrow-path')
                    ->color('warning')
                    ->requiresConfirmation()
                    ->modalHeading('Produkt mit Digitec abgleichen')
                    ->modalDescription('Das Produkt wird mit Digitec abgeglichen. Falls es dort nicht existiert, wird es gelöscht.')
                    ->action(function (Product $record): void {
                        $service = app(DigitecSyncService::class);
                        $result = $service->syncProduct($record);

                        match ($result['status']) {
                            'updated' => Notification::make()
                                ->title('Produkt aktualisiert')
                                ->body("Preis: CHF {$result['new_price']}")
                                ->success()
                                ->send(),
                            'deleted' => Notification::make()
                                ->title('Produkt gelöscht')
                                ->body("{$result['product_name']} existiert nicht auf Digitec.")
                                ->warning()
                                ->send(),
                            default => Notification::make()
                                ->title('Fehler beim Abgleich')
                                ->body($result['message'])
                                ->danger()
                                ->send(),
                        };
                    }),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
