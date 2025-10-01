<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;
use Filament\Notifications\Notification;
use App\Models\Order;

class OrderNotificationWidget extends Widget
{
    protected static string $view = 'filament.widgets.order-notification';

    public $lastCheck;

    public function mount(): void
    {
        $this->lastCheck = now();
    }

    public function checkNewOrders(): void
    {
        $orders = Order::where('created_at', '>', $this->lastCheck)->get();

        foreach ($orders as $order) {
            Notification::make()
                ->title('🚨 Pesanan Baru Masuk!')
                ->body("Order #{$order->id} dengan metode {$order->payment_method}")
                ->danger()
                ->persistent()
                ->send(); // ini bikin popup muncul
        }

        $this->lastCheck = now();
    }
}
