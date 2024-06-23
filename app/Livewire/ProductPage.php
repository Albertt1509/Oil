<?php

namespace App\Livewire;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url ;

#[Title('Products - Evans')]
class ProductPage extends Component
{
    public $inStock = false;
    public $onSale = false;
    public $selected_categories = [];
    public $selected_brands = [];
    
    #[url]
    public $featured;

    #[url]
    public $on_sale;

    use WithPagination;
    public function render()
    {
        $productQuery = Product::query()->where('is_active', 1);
        if(!empty($this->selected_categories)){
            $productQuery->whereIn('category_id',$this->selected_categories);
        }

        if(!empty($this->selected_brands)){
            $productQuery->whereIn('brand_id',$this->selected_brands);
        }

        if($this->featured){
            $productQuery->where('is_featured',1);
        }
        if($this->on_sale){
            $productQuery->where('on_sale',1);
        }
        return view('livewire.product-page', [
            'products' => $productQuery->paginate(9),
            'brands' => Brand::where('is_active', 1)->get(['id', 'name', 'slug']),
            'categories' => Category::where('is_active', 1)->get(['id', 'name', 'slug'])
        ]);
    }
}
