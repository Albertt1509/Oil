<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Attributes\Title;
use Livewire\Component;
use App\Livewire\Partials\Navbar;
use App\Helpers\CartManagement;
use Jantinnerezo\LivewireAlert\LivewireAlert;

#[Title('Product Detail - Evans')]
class ProductDetailPage extends Component
{
    use LivewireAlert;

    public $slug;
    public $quantity = 1;

    public function plus(){
        $this->quantity ++;
    }

       public function addToCart($product_id){
    $total_count = CartManagement::addItemsCart($product_id);
    
    $this->dispatch('update-cart-count',total_count: $total_count)->to(Navbar::class);

    $this->alert('success', 'Product Added!', [
    'position' => 'center',
    'timer' => 3000,
    'toast' => true,
    ]);
}

    public function minus(){
        if($this->quantity>1){
            $this->quantity--;
        }
    }
    public function mount($slug){
        $this->slug=$slug;
    }
    public function render()
    {
        return view('livewire.product-detail-page',[
            'product'=>Product::where('slug',$this->slug)->firstOrFail()
        ]);
    }
}
