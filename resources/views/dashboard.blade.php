@extends('layouts.app')

@section('title', 'Dashboard - Point Of Sale')
@section('content')
    <div class="row">
        <div class="col-lg-3">
            <div class="card savings-card">
                <div class="card-body">
                    <h5 class="card-title">Total Barang<span class="card-title-helper"><i class="material-icons">inventory_2</i></span></h5>
                    <div class="savings-stats">
                        <h5>$4,502.00</h5>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="card savings-card">
                <div class="card-body">
                    <h5 class="card-title">Total Transaksi<span class="card-title-helper"><i class="material-icons">shopping_cart</i></span></h5>
                    <div class="savings-stats">
                        <h5>$4,502.00</h5>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="card savings-card">
                <div class="card-body">
                    <h5 class="card-title">Total Transaksi Hari Ini<span class="card-title-helper"><i class="material-icons">add_shopping_cart</i></span></h5>
                    <div class="savings-stats">
                        <h5>$4,502.00</h5>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="card savings-card">
                <div class="card-body">
                    <h5 class="card-title">Total Pengguna<span class="card-title-helper"><i class="material-icons">people</i></span></h5>
                    <div class="savings-stats">
                        <h5>$4,502.00</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card card-transactions">
                <div class="card-body">
                    <h5 class="card-title">Recent Transactions<a href="#" class="card-title-helper blockui-transactions"><i class="material-icons">refresh</i></a></h5>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Barang</th>
                                    <th scope="col">Harga</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Pakaian Pria</td>
                                    <td>$18, 560</td>
                                    <td><span class="badge badge-success">10</span></td>
                                    <td>$185, 600</td>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
