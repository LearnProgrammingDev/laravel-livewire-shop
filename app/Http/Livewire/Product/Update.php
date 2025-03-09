<?php

namespace App\Http\Livewire\Product;


use App\Product;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

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

    // mengambil data dari id yang di kirim di route
    public function mount($id)
    {
        $product = Product::findOrFail($id);
        $this->productId = $product->id;
        $this->title = $product->title;
        $this->description = $product->description;
        $this->price = $product->price;
        $this->imageOld = asset('/storage/' . $product['image']);
    }

    public function update()
    {
        $this->validate([
            'title' => 'required|min:3',
            'description' => 'required|max:180',
            'price' => 'required|numeric',
            'image' => 'nullable|image|max:1024'  // tambahkan nullable
        ]);

        if ($this->productId) {
            $product = Product::find($this->productId);

            $image = '';

            if ($this->image) {
                // Hapus gambar lama jika ada
                if ($product->image && Storage::disk('public')->exists($product->image)) {
                    Storage::disk('public')->delete($product->image);
                }

                $imageName = Str::slug($this->title, '-')
                    . '-'
                    . uniqid()
                    . '.' . $this->image->getClientOriginalExtension();

                $this->image->storeAs('public', $imageName, 'local');

                $image = $imageName;
            } else {
                $image = $product->image;
            }

            // Debug untuk memastikan data benar
            // dd([
            //     'title' => $this->title,
            //     'price' => $this->price,
            //     'description' => $this->description,
            //     'image' => $image
            // ]);

            $updated = $product->update([
                'title' => $this->title,
                'price' => $this->price,
                'description' => $this->description,
                'image' => $image
            ]);

            // Tambahkan debugging
            // dd($updated, $product->fresh());

            // Notifikasi data berhasil diubah
            session()->flash('pesan', 'Data berhasil diupdate');

            // Tambahkan redirect
            return redirect()->route('admin.product.index');
        }
    }
}
