@extends('layouts.guest')

@section('title', 'Verify Email')

@section('content')
<p class="login-box-msg">{{ __('Verify Your Email Address') }}</p>

@if (session('resent'))
    <div class="alert alert-success" role="alert">
        {{ __('A fresh verification link has been sent to your email address.') }}
    </div>
@endif

<div class="mb-3">
    {{ __('Before proceeding, please check your email for a verification link.') }}
    {{ __('If you did not receive the email') }},
</div>

<form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
    @csrf
    <div class="d-grid gap-2">
        <button type="submit" class="btn btn-primary btn-block">{{ __('Click here to request another') }}</button>
    </div>
</form>
@endsection
