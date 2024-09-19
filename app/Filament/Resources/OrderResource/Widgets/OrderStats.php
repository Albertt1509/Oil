<?php

namespace App\Filament\Resources\OrderResource\Widgets;

use App\Models\Order;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Number;

class OrderStats extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('New Orders', Order::query()->where('status', 'new')->count()),
            Stat::make('Order Proccessing', Order::query()->where('status', 'processing')->count()),
            Stat::make('Order Shipped', Order::query()->where('status', 'shipped')->count()),
            Stat::make('Total Sales', Number::currency($this->getTotalSales(), 'IDR')),
        ];
    }

    protected function getTotalSales(): float
    {
        // Menggunakan DB facade untuk menghitung total penjualan dari semua pesanan
        $totalSales = DB::table('orders')->sum('grand_total');

        return $totalSales;
    }
}
