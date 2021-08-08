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
                <form method="POST" action="{{ route('change.password.update')}}">
                    @csrf
                    <div class="form-group">
                        <label for="current_password">Password</label>
                        <input type="password" class="form-control @error('current_password') is-invalid @enderror" id="current_password" name="current_password" aria-describedby="passwordHelp" placeholder="Enter Old Password" value="{{ old('current_password') }}" required>
                        @error('current_password') <span class="text-form text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="new_password">New Password</label>
                        <input type="password" class="form-control @error('new_password') is-invalid @enderror" id="new_password" name="new_password" aria-describedby="new_passwordHelp" placeholder="Enter New Password" value="{{ old('new_password') }}" required>
                        @error('new_password') <span class="text-form text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="new_confirm_password">New Password</label>
                        <input type="password" class="form-control @error('new_confirm_password') is-invalid @enderror" id="new_confirm_password" name="new_confirm_password" aria-describedby="new_confirm_passwordHelp" placeholder="Enter Confirm New Password" value="{{ old('new_confirm_password') }}" required>
                        @error('new_confirm_password') <span class="text-form text-danger">{{ $message }}</span> @enderror
                    </div>
                    <button type="submit" class="btn btn-warning btn-sm">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
