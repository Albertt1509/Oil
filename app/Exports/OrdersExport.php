<?php

namespace App\Exports;

use App\Models\Order;

class OrdersExport
{
    public function exportCsv()
    {
        $orders = Order::with('orderItems')->get();

        $filename = "orders.csv";
        $handle = fopen($filename, 'w');
        fputcsv($handle, ['ID Order', 'Tanggal', 'Nama Pembeli', 'Jumlah Item', 'Total Harga']);

        foreach ($orders as $order) {
            fputcsv($handle, [
                $order->id,
                $order->created_at->format('Y-m-d'),
                $order->customer_name ?? 'N/A',
                $order->orderItems->sum('quantity'),
                $order->total_amount,
            ]);
        }

        fclose($handle);

        return response()->download($filename)->deleteFileAfterSend(true);
    }
}
