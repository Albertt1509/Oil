<?php

namespace App\Filament\Exports;

use App\Models\Cogs;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;

class CogsExporter extends Exporter
{
    protected static ?string $model = Cogs::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('id')->label('ID'),
            ExportColumn::make('name')->label('Nama Produk'),
            ExportColumn::make('selling_price')->label('Harga Jual'),
            ExportColumn::make('quantity')->label('Jumlah'),
        ];
    }

    // nonaktifkan chunk
    protected int $chunkSize = 0;

    // ubah writer jadi Excel (XLSX)
    protected string $fileExtension = 'xlsx';
    protected string $writerType = \Filament\Actions\Exports\Writers\XlsxWriter::class;

    public static function getCompletedNotificationBody(Export $export): string
    {
        return 'Export data berhasil. File tersedia untuk diunduh.';
    }
}
