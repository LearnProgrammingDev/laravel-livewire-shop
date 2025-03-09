<div class="row justify-content-center mb-2">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                Product
                <a href="{{ route('admin.product') }}" class="btn btn-sm btn-secondary">Back to Products</a>
            </div>
            <div class="card-body">
                @if (session()->has('pesan'))
                    <div class="alert alert-success">
                        {{ session('pesan') }}
                    </div>
                @endif
                <form wire:submit.prevent="store" method="POST" enctype="multipart/form-data">

                    <div class="form-group">

                        <div class="form-row">
                            <div class="col">
                                <input wire:model="title" type="text"
                                    class="form-control @error('title') is-invalid @enderror" placeholder="Title">
                                @error('title')
                                    <span class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col">
                                <input wire:model="price" type="text"
                                    class="form-control @error('price') is-invalid @enderror" placeholder="Price">
                                @error('title')
                                    <span class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                    </div>

                    <div class="form-group">

                        <div class="form-row">
                            <div class="col">
                                <input wire:model="description" type="text"
                                    class="form-control @error('description') is-invalid @enderror"
                                    placeholder="Description">
                                @error('title')
                                    <span class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>
                        </div>

                    </div>

                    <div class="form-group">

                        <div class="form-row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="">Image</label>
                                    <input wire:model="image" type="file" class="form-control-file" id="image">
                                    @error('image')
                                        <span class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    @if ($image)
                                        <img src="{{ $image->temporaryUrl() }}" alt="" height="200">
                                    @endif
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="btn-group" role="group" aria-label="Button Form">
                        <button type="submit" class="btn btn-sm btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
