 @extends('layouts.guest')

@section('title', 'Register')

@section('content')
<p class="login-box-msg">Register a new membership</p>

<form method="POST" action="{{ route('register') }}">
    @csrf
    
    <div class="input-group mb-3">
        <input type="text" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus 
               class="form-control @error('name') is-invalid @enderror" placeholder="Full Name">
        <div class="input-group-text">
            <span class="fas fa-user"></span>
        </div>
        @error('name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>

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
               class="form-control" placeholder="Retype password">
        <div class="input-group-text">
            <span class="fas fa-lock"></span>
        </div>
    </div>

    <div class="row">
        <div class="col-8">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="terms" id="terms" required>
                <label class="form-check-label" for="terms">
                    I agree to the <a href="#">terms</a>
                </label>
            </div>
        </div>
        <!-- /.col -->
        <div class="col-4">
            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-primary btn-block">Register</button>
            </div>
        </div>
        <!-- /.col -->
    </div>
</form>

<div class="social-auth-links text-center mb-3">
    <p>- OR -</p>
    <a href="#" class="btn btn-block btn-outline-danger">
        <i class="fab fa-google-plus-g mr-2"></i> Sign up using Google+
    </a>
</div>

<a href="{{ route('login') }}" class="text-center">I already have a membership</a>
@endsection
