@extends('layouts.app')

@section('title', 'Dashboard - Point Of Sale')
@section('content')
    <div class="row">
        <div class="col-lg-3">
            <div class="card savings-card">
                <div class="card-body">
                    <h5 class="card-title">Total Product<span class="card-title-helper"><i class="material-icons">inventory_2</i></span></h5>
                    <div class="savings-stats">
                        <h5>{{ $products }}</h5>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="card savings-card">
                <div class="card-body">
                    <h5 class="card-title">Total Transaction<span class="card-title-helper"><i class="material-icons">shopping_cart</i></span></h5>
                    <div class="savings-stats">
                        <h5>{{ $transactions }}</h5>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="card savings-card">
                <div class="card-body">
                    <h5 class="card-title">Total Category<span class="card-title-helper"><i class="material-icons">add_shopping_cart</i></span></h5>
                    <div class="savings-stats">
                        <h5>{{ $categories }}</h5>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="card savings-card">
                <div class="card-body">
                    <h5 class="card-title">Total User<span class="card-title-helper"><i class="material-icons">people</i></span></h5>
                    <div class="savings-stats">
                        <h5>{{ $users }}</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card card-transactions">
                <div class="card-body">
                    <h5 class="card-title">Recent Transactions</h5>
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
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="12"><p class="text-danger text-center">Data Empty !</p></td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
