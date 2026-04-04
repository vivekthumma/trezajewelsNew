@extends('layouts.app')

@section('title', 'Login - Treza Jewels')

@push('css')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/account.css') }}">
@endpush

@section('content')
<!-- breadcrumb-area start -->
<div class="breadcrumb-area ptb-15" data-bgimg="{{ asset('assets/images/other/breadcrumb-bgimg.jpg') }}">
    <div class="container">
        <span class="d-block extra-color"><a href="{{ url('/') }}" class="extra-color">Home</a> / Login</span>
    </div>
</div>
<!-- breadcrumb-area end -->

<!-- login start -->
<section class="customer-account section-ptb">
    <div class="container">
        <div class="section-capture text-center">
            <div class="section-title">
                <h2 class="section-heading">Login account</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-md-8 col-lg-6 col-xl-5 mx-md-auto">
                <form method="post" action="{{ route('login') }}">
                    @csrf
                    <div class="row field-row">
                        <div class="col-12 field-col">
                            <label for="email" class="field-label">Email</label>
                            <input type="email" id="email" name="email" class="w-100 @error('email') is-invalid @enderror" placeholder="Email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                            @error('email')
                                <span class="invalid-feedback d-block" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-12 field-col">
                            <label for="password" class="field-label">Password</label>
                            <div class="field-pwd d-flex">
                                <input type="password" id="password" name="password" class="w-100 h-auto p-0 bg-transparent border-0 @error('password') is-invalid @enderror" placeholder="Password" required autocomplete="current-password">
                                <button type="button" class="field-pwd-btn body-color icon-16 js-show-password" aria-label="Password hidden"><i class="ri-eye-line d-block lh-1"></i></button>
                            </div>
                            @error('password')
                                <span class="invalid-feedback d-block" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="mst-12 text-center">
                        <a href="{{ route('password.request') }}" class="body-secondary-color text-decoration-underline">Forgot your password?</a>
                    </div>
                    <div class="customer-account-btn mst-20 mst-sm-30">
                        <button type="submit" class="w-100 btn-style secondary-btn">Sign in</button>
                    </div>
                </form>
                <div class="mst-12 text-center">Don't have an account? <a href="{{ route('register') }}" class="body-secondary-color text-decoration-underline">Create an account</a></div>
            </div>
        </div>
    </div>
</section>
<!-- login end -->
@endsection

@push('js')
<script>
    $(document).ready(function() {
        $('.js-show-password').on('click', function() {
            const input = $(this).siblings('input');
            const type = input.attr('type') === 'password' ? 'text' : 'password';
            input.attr('type', type);
            $(this).find('i').toggleClass('ri-eye-line ri-eye-off-line');
        });
    });
</script>
@endpush
