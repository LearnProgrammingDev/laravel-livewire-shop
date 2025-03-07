<?php

namespace App\Http\Livewire\Product;

use App\Product;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $paginate = 5;
    public $search;

    protected $updatesQueryString = [
        ['search' => ['except' => '']],
    ];


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
}
