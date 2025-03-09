<?php

namespace App\Http\Livewire\Product;

use App\Product;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Storage;

class Index extends Component
{
    use WithPagination;

    public $paginate = 5;
    public $search;
    public $formvisible;


    protected $updatesQueryString = [
        ['search' => ['except' => '']],
    ];

    // protected $listeners = [
    //     'formClose' => 'formCloseHandler'
    // ];

    // public function formCloseHandler()
    // {
    //     $this->formvisible = false;
    // }

    public function mount()
    {
        $this->search = request()->query('search', $this->search);
    }
    public function render()
    {
        return view('livewire.product.index', [
            'products' => $this->search === null ? //pengecekan dengan operasi ternari jika kolom search ada isinya
                Product::latest()->paginate($this->paginate) :
                Product::latest()->where('title', 'like', '%' . $this->search . '%')
                ->paginate($this->paginate)
        ]);
    }


    public function deleteProduct($productId)
    {
        $product = Product::find($productId);

        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();
        session()->flash('hapus', 'Product was deleted!');
    }
}
