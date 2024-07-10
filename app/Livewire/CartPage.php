<?php

namespace App\Livewire;

use Livewire\Component;
use App\Helpers\CartManagement;
use App\Livewire\Partials\Navbar;
use livewire\Attributes\Title;

#[Title('Evan- Cart')]
class CartPage extends Component
{
    public $cart_items=[];
    public $grand_total;

    public function removeItem($product_id){
        $this->cart_items = CartManagement::removeCartItem($product_id);
        $this->grand_total = CartManagement::calculateGrandTotal($this->cart_items);
        $this->dispatch('update-cart-count',total_count:count($this->cart_items))->to(Navbar::class);
    }

    public function increaseQty($product_id){
        $this->cart_items = CartManagement::incrementQuantityToCrtItem($product_id);
        $this->grand_total = CartManagement::calculateGrandTotal($this->cart_items);
    }
    
    public function decreaseQty($product_id){
        $this->cart_items = CartManagement::incrementQuantityToCrtItem($product_id);
        $this->grand_total = CartManagement::calculateGrandTotal($this->cart_items);
    }

    public function mount(){
        $this -> cart_items = CartManagement::getCartItemsCookie();
        $this -> grand_total = CartManagement::calculateGrandTotal($this->cart_items);
    }
    public function render()
    {
        return view('livewire.cart-page');
    }
}
