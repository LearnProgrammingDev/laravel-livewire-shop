<?php

namespace App\Http\Livewire\Shop;

use Livewire\Component;

use App\Facades\Cart as FacadesCart;

class Cart extends Component
{


    public $cart;

    public function mount()
    {
        $this->cart = FacadesCart::get();
    }

    public function render()
    {
        return view('livewire.shop.cart');
    }
}
