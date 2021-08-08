<div>
    <div class="row">
        <div class="col-lg-12 mx-auto">
            <div class="card card-transactions">
                <div class="card-body">
                    <h5 class="card-title">Report<button wire:click="export_mapping" type="button" class="btn btn-success btn-sm float-right pb-0"><i class="material-icons">cloud_download</i></button></h5>
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
                                    <th scope="col">No Invoice</th>
                                    <th scope="col">Cashier Name</th>
                                    <th scope="col">Products Bought</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Category</th>
                                    <th scope="col">Total</th>
                                    <th scope="col">Pay</th>
                                    <th scope="col">Change</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($datas as $data)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $data->code }}</td>
                                    <td>{{ $data->cashier_name }}</td>
                                    <td class="font-weight-bold">
                                        @foreach ($data->productOrder as $productOrder)
                                            <p>{{ $productOrder->product->name }}</p>
                                        @endforeach
                                    </td>
                                    <td class="font-weight-bold">
                                        @foreach ($data->productOrder as $productOrder)
                                            <p>{{ $productOrder->qty }}</p>
                                        @endforeach
                                    </td>
                                    <td class="font-weight-bold">
                                        @foreach ($data->productOrder as $productOrder)
                                            <p>{{ $productOrder->product->category->name }}</p>
                                        @endforeach
                                    </td>
                                    <td><span>Rp. {{ number_format($data->total) }}</span></td>
                                    <td><span>Rp. {{ number_format($data->pay) }}</span></td>
                                    <td><span>Rp. {{ number_format($data->change) }}</span></td>
                                    <td>
                                        <form method="GET" action="{{ route('invoice', $data->code) }}">
                                            <button type="submit" class="btn btn-primary"><span class="material-icons" style="font-size: 15px;">print</span></button>
                                        </form>
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
                                {{ $datas->links() }}
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.2/dist/alpine.min.js" defer></script>
@endpush
