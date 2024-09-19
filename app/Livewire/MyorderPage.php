<?php

namespace App\Livewire;

use App\Models\Order;
use Livewire\Component;
use Livewire\WithPagination;

class MyorderPage extends Component
{
    use WithPagination;
    public function render()
    {
        $my_orders=Order::where('user_id',auth()->id())->latest()->paginate(2);
        return view('livewire.myorder-page',[
            'orders'=>$my_orders
        ]);
    }
}
