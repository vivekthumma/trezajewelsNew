@extends('layouts.guest')

@section('title', 'Reset Password')

@section('content')
<p class="login-box-msg">You are only one step away from your new password, recover your password now.</p>

<form method="POST" action="{{ route('password.update') }}">
    @csrf
    
    <input type="hidden" name="token" value="{{ $token }}">

    <div class="input-group mb-3">
        <input type="email" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" 
               class="form-control @error('email') is-invalid @enderror" placeholder="Email">
        <div class="input-group-text">
            <span class="fas fa-envelope"></span>
        </div>
        @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>

    <div class="input-group mb-3">
        <input type="password" name="password" required autocomplete="new-password" 
               class="form-control @error('password') is-invalid @enderror" placeholder="Password">
        <div class="input-group-text">
            <span class="fas fa-lock"></span>
        </div>
        @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>

    <div class="input-group mb-3">
        <input type="password" name="password_confirmation" required autocomplete="new-password" 
               class="form-control" placeholder="Confirm Password">
        <div class="input-group-text">
            <span class="fas fa-lock"></span>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-primary btn-block">Reset password</button>
            </div>
        </div>
        <!-- /.col -->
    </div>
</form>
@endsection
