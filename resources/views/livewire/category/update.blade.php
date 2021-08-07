<div>
    <div class="row">
        <div class="col-lg-8 mx-auto">
            <div class="card">
                <div class="card-body">
                    <form wire:submit.prevent="update">
                        <input type="hidden" wire:model="categoryId">
                        <div class="form-group">
                            <label for="name">Category Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" wire:model="name" aria-describedby="nameHelp" placeholder="Enter category name" required>
                            <small id="nameHelp" class="form-text text-muted">Minimal 4 characters !</small>
                        </div>
                        <button type="submit" class="btn btn-warning btn-sm">Update</button>
                        <button wire:click="$emit('formClose')" type="button" class="btn btn-danger btn-sm">Close</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
