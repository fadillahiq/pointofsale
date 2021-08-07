@extends('layouts.app')

@section('title', 'Transaction - Point Of Sale')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card card-transactions">
            <livewire:transaction.index />
        </div>
    </div>
</div>
@endsection
