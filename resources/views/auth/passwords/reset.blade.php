@extends('layouts.auth')

@section('title', 'Reset Password')
@section('header', 'Reset Password')
@section('content')
    <form method="POST" action="{{ route('password.update') }}">
        @csrf

        <input type="hidden" name="token" value="{{ $token }}">

        <div class="form-group">
            <input type="email" name="email" class="form-control  @error('email') is-invalid @enderror" id="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus placeholder="Enter email">

            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group">
            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="password" required autocomplete="current-password" placeholder="Password">

            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group">
            <input type="password" name="password_confirmation" class="form-control" id="password_confirmation" required autocomplete="confirm-password" placeholder="Confirm Password">
        </div>
        <button type="submit" class="btn btn-primary btn-block btn-submit">Reset Password</button>
    </form>
@endsection
