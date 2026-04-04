@extends('layouts.guest')

@section('title', 'Confirm Password')

@section('content')
<p class="login-box-msg">{{ __('Please confirm your password before continuing.') }}</p>

<form method="POST" action="{{ route('password.confirm') }}">
    @csrf
    
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
        <div class="col-12">
            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-primary btn-block">{{ __('Confirm Password') }}</button>
            </div>
            @if (Route::has('password.request'))
                <p class="text-center mt-3">
                    <a href="{{ route('password.request') }}">{{ __('Forgot Your Password?') }}</a>
                </p>
            @endif
        </div>
        <!-- /.col -->
    </div>
</form>
@endsection
