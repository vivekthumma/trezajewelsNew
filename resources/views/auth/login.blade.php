@extends('layouts.guest')

@section('title', 'Sign In')

@section('content')
<p class="login-box-msg">Sign in to start your session</p>

<form method="POST" action="{{ route('login') }}">
    @csrf
    
    <div class="input-group mb-3">
        <input type="email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus 
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
        <input type="password" name="password" required autocomplete="current-password" 
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

    <div class="row">
        <div class="col-8">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                <label class="form-check-label" for="remember">
                    Remember Me
                </label>
            </div>
        </div>
        <!-- /.col -->
        <div class="col-4">
            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-primary">Sign In</button>
            </div>
        </div>
        <!-- /.col -->
    </div>
</form>

<div class="social-auth-links text-center mb-3">
    <p>- OR -</p>
    <a href="#" class="btn btn-block btn-outline-danger">
        <i class="fab fa-google-plus-g mr-2"></i> Sign in using Google+
    </a>
</div>
<!-- /.social-auth-links -->

@if (Route::has('password.request'))
    <p class="mb-1">
        <a href="{{ route('password.request') }}">I forgot my password</a>
    </p>
@endif

@if (Route::has('register'))
    <p class="mb-0">
        <a href="{{ route('register') }}" class="text-center">Register a new membership</a>
    </p>
@endif
@endsection
