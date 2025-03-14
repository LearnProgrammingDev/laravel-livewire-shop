<div class="container">
    {{-- @livewire('product.create') --}}
    {{-- @if ($formvisible)
        @livewire('product.create')
    @endif --}}
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Product
                    <a href="{{ route('admin.product.create') }}" class="btn btn-sm btn-primary">Create</a>
                </div>

                <div class="card-body">
                    @if (session()->has('pesan'))
                        <div class="alert alert-success">
                            {{ session('pesan') }}
                        </div>
                    @endif

                    @if (session()->has('hapus'))
                        <div class="alert alert-danger">
                            {{ session('hapus') }}
                        </div>
                    @endif
                    <div class="row">
                        <div class="col">
                            <select wire:model="paginate" name="" id=""
                                class="form-control form-control-sm w-auto">
                                <option value="5">5</option>
                                <option value="10">10</option>
                                <option value="15">15</option>
                                <option value="20">20</option>
                            </select>
                        </div>
                        <div class="col">
                            <input wire:model="search" type="text" class="form-control form-control-sm"
                                placeholder="Search">
                        </div>
                    </div>

                    <hr>


                    <table class="table">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Title</th>
                                <th scope="col">Price</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 0; ?>
                            @foreach ($products as $product)
                                <?php $no++; ?>
                                <tr>
                                    <th scope="row">{{ $no }}</th>
                                    <td>{{ $product->title }}</td>
                                    <td>Rp{{ number_format($product->price, 2, ',', '.') }}</td>
                                    <td>
                                        <a href="{{ route('admin.product.update', $product->id) }}"
                                            class="btn btn-sm btn-info text-white">Edit</a>
                                        <button wire:click="deleteProduct({{ $product->id }})"
                                            class="btn btn-sm btn-danger">Delete</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @if ($products->hasPages())
                        {{ $products->links() }} <!-- ✔️ Panggil links() hanya jika ada halaman -->
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
