@extends('layouts.guest')

@section('title', 'Forgot Password')

@section('content')
<p class="login-box-msg">You forgot your password? Here you can easily retrieve a new password.</p>

@if (session('status'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('status') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<form method="POST" action="{{ route('password.email') }}">
    @csrf
    
    <div class="input-group mb-3">
        <input type="email" name="email" value="{{ old('email') }}" required autocomplete="email" 
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

    <div class="row">
        <div class="col-12">
            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-primary btn-block">Request new password</button>
            </div>
        </div>
        <!-- /.col -->
    </div>
</form>

<p class="mt-3 mb-1 text-center">
    <a href="{{ route('login') }}">Login</a>
</p>
@endsection
