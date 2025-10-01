<?php

namespace App\Filament\Pages;

use Filament\Pages\Dashboard as BaseDashboard;
use Filament\Actions\Action;
use Filament\Notifications\Notification;
use App\Models\Order;

class Dashboard extends BaseDashboard
{
    public $latestOrder;

    public function mount()
    {
        $this->latestOrder = Order::latest()->first();

        if ($this->latestOrder && in_array($this->latestOrder->payment_method, ['Transfer', 'QRIS'])) {
            // Send Livewire notification
            Notification::make()
                ->title('New Order 🚀')
                ->body("Order #{$this->latestOrder->id} has been placed using {$this->latestOrder->payment_method}.")
                ->success()
                ->send();
        }
    }

    protected function getHeaderActions(): array
    {
        $actions = [];

        if ($this->latestOrder && in_array($this->latestOrder->payment_method, ['Transfer', 'QRIS'])) {
            $actions[] = Action::make('viewOrder')
                ->label('View Order')
                ->modalHeading('New Order Received')
                ->modalContent(view('filament.modals.new-order', [
                    'order' => $this->latestOrder,
                ]))
               ->modalActions([
        Action::make('goToOrder')
            ->label('Go to Order')
            ->url('http://127.0.0.1:8000/admin/orders', shouldOpenInNewTab: false),
    ]);

        }

        return $actions;
    }
}
