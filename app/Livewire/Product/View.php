<?php

namespace App\Livewire\Product;

use Livewire\Component;
use App\Models\CategoryProduct;
use Livewire\Attributes\On; 

class View extends Component
{
    public CategoryProduct $product;

    #[On('openViewModal')]
    public function openViewModal($category_product_id)
    {
        $this->product = CategoryProduct::find($category_product_id);
        $this->render();
        $this->dispatch('openViewProductModal');
    }

    public function render()
    {
        return view('livewire.product.view');
    }
}
