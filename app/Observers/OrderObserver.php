<?php

namespace App\Observers;

use App\Models\Order;
use Filament\Notifications\Notification;

class OrderObserver
{
    public function created(Order $order): void
    {
        if (in_array($order->payment_method, ['Transfer', 'Qris'])) {
            Notification::make()
                ->title('🚨 Pesanan Baru Masuk!')
                ->body("Order #{$order->id} dengan metode {$order->payment_method}. Tolong segera konfirmasi.")
                ->danger()
                ->persistent()
                ->sendToDatabase($order); // simpan ke DB
        }
    }
}
