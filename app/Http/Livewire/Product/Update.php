<?php

namespace App\Http\Livewire\Product;

use App\Product;
use Livewire\Component;
use Livewire\WithFileUploads;

class Update extends Component
{
    use WithFileUploads;

    public $productId;
    public $title;
    public $description;
    public $price;
    public $image;
    public $imageOld;

    public function render()
    {
        return view('livewire.product.update');
    }

    public function mount($id)
    {
        $product = Product::findOrFail($id);
        $this->productId = $product->id;
        $this->title = $product->title;
        $this->description = $product->description;
        $this->price = $product->price;
        $this->imageOld = asset('/storage/' . $product['image']);
    }
}
