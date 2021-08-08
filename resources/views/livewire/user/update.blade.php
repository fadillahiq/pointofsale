<div>
    <div class="row">
        <div class="col-lg-8 mx-auto">
            <div class="card">
                <div class="card-body">
                    <form wire:submit.prevent="update">
                        <input type="hidden" wire:model="userId">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" wire:model="name" aria-describedby="nameHelp" placeholder="Enter name" required>
                            @error('name') <span class="text-form text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" wire:model="email" aria-describedby="emailHelp" placeholder="Enter email" required>
                            @error('email') <span class="text-form text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label for="role">Role</label>
                            <select wire:ignore class="form-control" wire:model="role" id="role" required>
                                <option value="admin" @if($role == "admin") selected @endif>Admin</option>
                                <option value="cashier"@if($role == "cashier") selected @endif>Cashier</option>
                            </select>
                            @error('role') <span class="text-form text-danger">{{ $message }}</span> @enderror
                        </div>
                        <button type="submit" class="btn btn-warning btn-sm">Update</button>
                        <button wire:click="$emit('formClose')" type="button" class="btn btn-danger btn-sm">Close</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
