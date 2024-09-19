<?php

namespace App\Livewire;

use App\Models\Order;
use Livewire\Component;

class SuccessPage extends Component
{   
    
    public $session_id;
    public function render()
    {
        $latest_order = Order::with('address')
            ->where('user_id', auth()->user()->id)
            ->latest()
            ->first();

        return view('livewire.success-page', [
            'order' => $latest_order,
        ]);
    }
}
