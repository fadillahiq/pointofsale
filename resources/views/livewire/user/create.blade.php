<div>
    <div class="row">
        <div class="col-lg-8 mx-auto">
            <div class="card">
                <div class="card-body">
                    <form wire:submit.prevent="store" enctype="multipart/form-data">
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
                            <label for="password">Password</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" wire:model="password" aria-describedby="passwordHelp" placeholder="Enter password" required>
                            @error('password') <span class="text-form text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label for="role">Role</label>
                            <select class="form-control" wire:model="role" id="role" required>
                                <option value="">Select Role</option>
                                <option value="admin">Admin</option>
                                <option value="cashier">Cashier</option>
                            </select>
                            @error('role') <span class="text-form text-danger">{{ $message }}</span> @enderror
                        </div>
                        <button type="submit" class="btn btn-primary btn-sm">Save</button>
                        <button wire:click="$emit('formClose')" type="button" class="btn btn-danger btn-sm">Close</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
