<?php

namespace App\Filament\Resources\COGSResource\Pages;

use App\Filament\Resources\COGSResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCOGS extends ListRecords
{
    protected static string $resource = COGSResource::class;

    // protected function getHeaderActions(): array
    // {
    //     return [
    //         Actions\CreateAction::make(),
    //     ];
    // }
}
