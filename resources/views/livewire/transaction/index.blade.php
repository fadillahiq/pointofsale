<div>
    <style>
        .qty {
            width: 20%;
            display: inline;
        }
        @media screen and (max-width: 767px) {
            .mobile-space {margin-top:10px;}
            .quantity {margin-top:10px;}
        }
    </style>
        <div class="card-body border-bottom">
            <h5 class="card-title">Transactions</h5>
            <div class="form-group pb-5">
                <form class="row mt-3" wire:submit.prevent="store">
                    <div class="col-lg-3" wire:ignore>
                        <select class="form-control @error('product_id') is-invalid @enderror" wire:model="product_id" required data-live-search="true">
                                <option value="">Choose Product</option>
                                @foreach ($products as $product)
                                    <option value="{{ $product->id }}" data-tokens="{{ $product->name }}">{{ $product->name }}</option>
                                @endforeach
                        </select>
                        @error('product_id') <span class="text-danger">Product already added !</span> @enderror
                    </div>
                    <div class="col-lg-3 quantity">
                        <div class="form-group">
                            <input type="number" class="form-control @error('qty') is-invalid @enderror" wire:model="qty"required placeholder="Enter quantity" />
                        </div>
                        @error('qty') <span class="text-danger">Quantity should not exceed stock and minimal 1 !</span> @enderror
                    </div>
                    <div class="col-lg-2 mobile-space">
                        <button type="submit" class="btn btn-success">Submit</button>
                    </div>
                </form>
            </div>

            @if (session()->has('message'))
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: '{!! session('message') !!}'
                })
            </script>
            @endif
            {{-- @if (session()->has('success'))
            <script>
                Swal.fire(
                 'Success',
                 '{!! session('success') !!}',
                 'success'
                 )
            </script>
            @endif --}}
        </div>
        <div class="card-body pb-5 mt-3">
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Product Name</th>
                            <th scope="col">Qty</th>
                            <th scope="col">Price/Qty</th>
                            <th scope="col" style="width: 200px;">Total</th>
                            <th scope="col" style="width: 10px;"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($transactions as $transaction)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $transaction->product->name }}</td>
                                <td>
                                    <div>
                                        @if($transaction->qty > 1)
                                            <span class="btn btn-danger btn-sm" wire:click="decrement({{ $transaction->id }})">-</span>
                                        @endif
                                        <input type="text" class="form-control qty text-center" value="{{ $transaction->qty }}" readonly>
                                        @if($transaction->product->stock >= 1)
                                            <span class="btn btn-success btn-sm hide" wire:click="increment({{ $transaction->id }})">+</span>
                                        @endif
                                    </div>
                                </td>
                                <td>Rp. {{ number_format($transaction->product->price) }}</td>
                                <td>Rp. {{ number_format($transaction->product->price * $transaction->qty) }}</td>
                                <td>
                                    <button wire:click="deleteTransaction({{ $transaction->id }})" class="btn btn-danger btn-sm"><i class="material-icons">delete</i></button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="12"><p class="text-center text-danger">Data Empty !</p></td>
                            </tr>
                        @endforelse
                    </tbody>
                    <tfoot>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td style="text-align:right;">Total Purchase</td>
                        <td>
                            Rp. {{ number_format($transactions->sum('total')) }}
                        </td>
                        <tr>
                            <td style="border:none;"></td>
                            <td style="border:none;"></td>
                            <td style="border:none;"></td>
                            <td style="text-align:right;">Pay</td>
                            <td style="text-align:right;">
                                <input type="number" wire:model="payInput" class="form-control">
                            </td>
                        </tr>
                        <tr>
                            <td style="border:none;"></td>
                            <td style="border:none;"></td>
                            <td style="border:none;"></td>
                            <td style="text-align:right;">Change</td>
                            <td style="text-align:left;" colspan="10">
                                Rp. {{ number_format($pay - $transactions->sum('total')) }}
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <div>
                <button wire:click="submit" class="btn btn-success btn-sm float-right">Submit</button>
            </div>
        </div>
</div>

@push('styles')
@endpush

@push('scripts')
@endpush
