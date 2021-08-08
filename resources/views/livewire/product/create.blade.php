<div>
    <div class="row">
        <div class="col-lg-8 mx-auto">
            <div class="card">
                <div class="card-body">
                    <form wire:submit.prevent="store">
                        <div class="form-group">
                            <label for="name">Product Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" wire:model="name" aria-describedby="nameHelp" placeholder="Enter product name" required>
                            @error('name') <span class="text-form text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label for="price">Price</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Rp.</span>
                                    </div>
                                    <input type="number" class="form-control @error('price') is-invalid @enderror" id="price" wire:model="price" aria-describedby="priceHelp" placeholder="Enter price" required>
                                </div>
                            @error('price') <span class="text-form text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label for="stock">Stock</label>
                            <input type="number" class="form-control @error('stock') is-invalid @enderror" id="stock" wire:model="stock" aria-describedby="stockHelp" placeholder="Enter stock" required>
                            @error('stock') <span class="text-form text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label for="category">Category</label>
                            <select class="form-control @error('category_id') is-invalid @enderror" id="category" wire:model="category_id" required>
                                <option value="">Choose Category</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                            @error('category_id') <span class="text-form text-danger">{{ $message }}</span> @enderror
                        </div>
                        <button type="submit" class="btn btn-primary btn-sm">Save</button>
                        <button wire:click="$emit('formClose')" type="button" class="btn btn-danger btn-sm">Close</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
