<div>
    <style>
        .qty {
            width: 20%;
            display: inline;
        }
        @media screen and (max-width: 767px) {
            .mobile-space {margin-top:10px;}
        }
    </style>
        <div class="card-body border-bottom">
            <div class="form-group pb-5">
                <form class="row mt-3" wire:submit.prevent="store">
                    <div class="col-lg-3">
                        <select class="form-control @error('product_id') is-invalid @enderror" wire:model="product_id" required>
                                <option value="">Choose Product</option>
                                @foreach ($products as $product)
                                <option value="{{ $product->id }}">{{ $product->name }}</option>
                                @endforeach
                        </select>
                        @error('product_id') <span class="text-danger">Product already added !</span> @enderror
                    </div>
                    <div class="col-lg-2 mobile-space">
                        <button type="submit" class="btn btn-success">Submit</button>
                    </div>
                </form>
            </div>

            @if (session()->has('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            @endif
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
                                        <span class="btn btn-success btn-sm" wire:click="increment({{ $transaction->id }})">+</span>
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
                            <td style="text-align:right;">Payment</td>
                            <td style="text-align:right;">
                                <input type="number" wire:model="paymentInput" class="form-control">
                            </td>
                        </tr>
                        <tr>
                            <td style="border:none;"></td>
                            <td style="border:none;"></td>
                            <td style="border:none;"></td>
                            <td style="text-align:right;">Change</td>
                            <td style="text-align:left;" colspan="10">
                                Rp. {{ number_format($payment - $transactions->sum('total')) }}
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <div>
                <button class="btn btn-success btn-sm float-right">Submit</button>
            </div>
        </div>
</div>

@push('styles')
<link href="{{ asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
@endpush

@push('scripts')
<script src="{{ asset('assets/js/pages/select2.js') }}"></script>
@endpush
