<?php

namespace App\Filament\Resources\Products\Pages;

use App\Filament\Resources\Products\ProductResource;
use App\Services\DigitecSyncService;
use Filament\Actions\Action;
use Filament\Actions\CreateAction;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ListRecords;

class ListProducts extends ListRecords
{
    protected static string $resource = ProductResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('syncAllDigitec')
                ->label('Alle mit Digitec abgleichen')
                ->icon('heroicon-o-arrow-path')
                ->color('warning')
                ->requiresConfirmation()
                ->modalHeading('Alle Produkte mit Digitec abgleichen')
                ->modalDescription('Alle Produkte werden mit Digitec abgeglichen. Produkte, die dort nicht existieren, werden unwiderruflich gelöscht.')
                ->action(function (): void {
                    $service = app(DigitecSyncService::class);
                    $results = $service->syncAll();

                    Notification::make()
                        ->title('Digitec-Abgleich abgeschlossen')
                        ->body(sprintf(
                            '%d aktualisiert, %d gelöscht, %d Fehler.',
                            $results['updated'],
                            $results['deleted'],
                            $results['errors'],
                        ))
                        ->success()
                        ->send();
                }),
            CreateAction::make(),
        ];
    }
}
