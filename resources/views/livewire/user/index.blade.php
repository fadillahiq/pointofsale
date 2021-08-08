<div>
    @if ($formVisible)
        @if ($statusUpdate)
            <livewire:user.update />
        @else
            <livewire:user.create />
        @endif
    @endif
    <div class="row">
        <div class="col-lg-8 mx-auto">
            <div class="card card-transactions">
                <div class="card-body">
                    <div>
                        @if (session()->has('message'))
                        <script>
                            Swal.fire(
                             'Success',
                             '{!! session('message') !!}',
                             'success'
                             )
                        </script>
                        @endif
                    </div>
                    <h5 class="card-title">Users<button wire:click="createUser" type="button" class="btn btn-primary btn-sm float-right pb-0"><i class="material-icons">add</i></button></h5>
                    <div class="d-flex justify-content-between mt-5">
                        <select class="form-control sm w-auto" wire:model="paginate">
                            <option value="10">10</option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                        </select>

                        <input type="text" class="form-control col-lg-4 col-md-3 col-sm-2" wire:model="search" placeholder="Search . . ." />
                    </div>
                    <hr>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Role</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($users as $user)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ Str::slug($user->getRoleNames()) }}</td>
                                    <td>
                                        <button wire:click="getUser({{ $user->id }})" class="btn btn-warning btn-sm">Edit</button>
                                        <button wire:click="deleteConfirm({{ $user->id }})" type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#exampleModal">
                                            Delete
                                        </button>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="12"><p class="text-danger text-center">Data Empty !</p></td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <nav aria-label="Page navigation example">
                            <ul class="pagination pagination-circle pl-2 pb-2">
                                {{ $users->links() }}
                            </ul>
                        </nav>
                    </div>
                    <div wire:ignore.self class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Delete User</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <i class="material-icons">close</i>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    Are you sure ?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="button" wire:click.prevent="deleteUser" class="btn btn-danger close-modal" data-dismiss="modal">Delete</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
