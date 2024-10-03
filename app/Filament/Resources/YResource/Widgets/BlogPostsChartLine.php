<?php

namespace App\Filament\Resources\YResource\Widgets;

use App\Models\Order;
use Filament\Widgets\ChartWidget;

class OrderLineChart extends ChartWidget
{
    protected static ?string $heading = 'Orders Per Month';

    protected function getData(): array
    {
        // Ambil data jumlah order berdasarkan bulan
        $orders = Order::selectRaw('MONTH(created_at) as month, COUNT(*) as total')
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        // Definisikan label bulan (misalnya dari Januari ke Desember)
        $months = [
            1 => 'January', 2 => 'February', 3 => 'March', 4 => 'April',
            5 => 'May', 6 => 'June', 7 => 'July', 8 => 'August',
            9 => 'September', 10 => 'October', 11 => 'November', 12 => 'December',
        ];

        return [
            'datasets' => [
                [
                    'label' => 'Number of Orders',
                    'data' => $orders->pluck('total')->toArray(), // Ambil jumlah order per bulan
                    'borderColor' => 'rgba(75, 192, 192, 1)', // Warna garis
                    'backgroundColor' => 'rgba(75, 192, 192, 0.2)', // Warna latar belakang area
                    'fill' => true, // Mengisi area di bawah garis
                ],
            ],
            'labels' => $orders->pluck('month')->map(function ($month) use ($months) {
                return $months[$month];
            })->toArray(), // Ubah angka bulan menjadi nama bulan
        ];
    }

    protected function getType(): string
    {
        return 'line'; // Menggunakan grafik jenis garis
    }

    protected function getConfig(): array
    {
        return [
            'height' => 300, // Atur tinggi grafik
            'width' => 600,  // Atur lebar grafik
        ];
    }
}
