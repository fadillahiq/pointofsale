@extends('layouts.app')

@section('title', 'Settings - Point Of Sale')
@section('content')
<div class="row">
    <div class="col-lg-8 mx-auto">
        <div class="card">
            <div class="card-body">
                @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    {{ $message }}
                </div>
                @endif
                <form method="POST" action="{{ route('profile.update', $user->id) }}">
                    @method('PUT')
                    @csrf
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ $user->name }}" aria-describedby="nameHelp" required>
                        @error('name') <span class="text-form text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ $user->email }}" aria-describedby="emailHelp" required>
                        @error('email') <span class="text-form text-danger">{{ $message }}</span> @enderror
                    </div>
                    <button type="submit" class="btn btn-warning btn-sm">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
