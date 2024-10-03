<?php

namespace App\Filament\Resources\YResource\Widgets;

use App\Models\Product; // Ganti Order dengan Product
use Filament\Widgets\ChartWidget;

class OrdersChart extends ChartWidget // Ganti nama kelas
{
    protected static ?string $heading = 'Products Per Month'; // Ubah judul chart

    protected function getData(): array
    {
        // Mengambil data produk dari database
        $products = Product::selectRaw('DATE_FORMAT(created_at, "%Y-%m") as month, COUNT(*) as count')
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        // Mengubah data menjadi format yang sesuai untuk chart
        $labels = $products->pluck('month')->toArray();
        $data = $products->pluck('count')->toArray();

        return [
            'labels' => $labels,
            'datasets' => [
                [
                    'label' => 'Products',
                    'data' => $data,
                    'backgroundColor' => 'rgba(75, 192, 192, 0.2)',
                    'borderColor' => 'rgba(75, 192, 192, 1)',
                    'borderWidth' => 1,
                ],
            ],
        ];
    }

    protected function getType(): string
    {
        return 'bar'; 
    }
}
