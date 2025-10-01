<?php

namespace App\Filament\Resources\RemaininStockResource\Pages;

use App\Filament\Resources\RemaininStockResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListRemaininStocks extends ListRecords
{
    protected static string $resource = RemaininStockResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
