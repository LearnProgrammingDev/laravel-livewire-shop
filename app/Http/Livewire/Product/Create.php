<?php

namespace App\Http\Livewire\Product;

use App\Product;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads;
    public $title;
    public $description;
    public $price;
    public $image;



    public function render()
    {
        return view('livewire.product.create');
    }

    public function store()
    {

        $this->validate([
            'title' => 'required|min:3',
            'description' => 'required|max:180',
            'price' => 'required|numeric',
            'image' => 'image|max:1024'
        ]);

        // proses menambahkan gambar
        $imageName = '';

        if ($this->image) {
            // simpan temporary named
            $imageName = Str::slug($this->title, '-')
                . '-'
                . uniqid()
                . '.' . $this->image->getClientOriginalExtension();

            // proses upload file
            $this->image->storeAs('public', $imageName, 'local');
            // $this->image = $imageName;
        }

        Product::create([
            'title' => $this->title,
            'price' => $this->price,
            'description' => $this->description,
            'image' => $imageName,
        ]);
        // dd($product);

        // $this->emit('productStored');

        // notifikasi data berhasil ditambahkan
        session()->flash('pesan', 'data berhasil ditambahkan');
    }
}
