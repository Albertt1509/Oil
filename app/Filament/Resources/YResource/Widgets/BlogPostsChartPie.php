<?php

namespace App\Filament\Resources\YResource\Widgets;

use App\Models\Order;
use Filament\Widgets\ChartWidget;

class OrderPieChart extends ChartWidget
{
    protected static ?string $heading = 'Order Status ';

    protected function getData(): array
    {
        
        // Ambil data jumlah order berdasarkan status
        $orders = Order::selectRaw('status, COUNT(*) as total')
            ->groupBy('status')
            ->get();

        // Tentukan warna untuk setiap status
        $colors = [
            'new' => 'rgba(54, 162, 235, 0.6)',       // Warna untuk status 'new'
            'processing' => 'rgba(255, 205, 86, 0.6)', // Warna untuk status 'processing'
            'shipped' => 'rgba(75, 192, 192, 0.6)',   // Warna untuk status 'shipped'
            'delivered' => 'rgba(153, 102, 255, 0.6)', // Warna untuk status 'delivered'
            'cancelled' => 'rgba(255, 99, 132, 0.6)',  // Warna untuk status 'cancelled'
        ];

        return [
            'datasets' => [
                [
                    'label' => 'Order Status',
                    'data' => $orders->pluck('total')->toArray(), // Ambil jumlah order per status
                    'backgroundColor' => $orders->pluck('status')->map(fn ($status) => $colors[$status])->toArray(), // Warna per status
                ],
            ],
            'labels' => $orders->pluck('status')->toArray(), // Status order sebagai label
        ];
    }

    protected function getType(): string
    {
        return 'pie'; // Menggunakan grafik jenis pie
    }
}
