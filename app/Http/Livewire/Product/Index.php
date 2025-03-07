<?php

namespace App\Http\Livewire\Product;

use App\Product;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    public $paginate = 3;
    public $search;
    use WithPagination;
    public function render()
    {
        $products = Product::paginate($this->paginate);
        return view('livewire.product.index', ['products' => $products]);
    }
}
