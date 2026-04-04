@extends('layouts.app')

@section('title', 'Register - Treza Jewels')

@push('css')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/account.css') }}">
@endpush

@section('content')
<!-- breadcrumb-area start -->
<div class="breadcrumb-area ptb-15" data-bgimg="{{ asset('assets/images/other/breadcrumb-bgimg.jpg') }}">
    <div class="container">
        <span class="d-block extra-color"><a href="{{ url('/') }}" class="extra-color">Home</a> / Register</span>
    </div>
</div>
<!-- breadcrumb-area end -->

<!-- register start -->
<section class="customer-account section-ptb">
    <div class="container">
        <div class="section-capture text-center">
            <div class="section-title">
                <h2 class="section-heading">Create an account</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-md-8 col-lg-6 col-xl-5 mx-md-auto">
                <form method="post" action="{{ route('register') }}">
                    @csrf
                    <div class="row field-row">
                        <div class="col-12 col-md-6 field-col">
                            <label for="fname" class="field-label">First name</label>
                            <input type="text" id="fname" name="fname" class="w-100 @error('fname') is-invalid @enderror" placeholder="First name" value="{{ old('fname') }}" required autocomplete="given-name">
                            @error('fname')
                                <span class="invalid-feedback d-block" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-12 col-md-6 field-col">
                            <label for="lname" class="field-label">Last name</label>
                            <input type="text" id="lname" name="lname" class="w-100 @error('lname') is-invalid @enderror" placeholder="Last name" value="{{ old('lname') }}" required autocomplete="family-name">
                            @error('lname')
                                <span class="invalid-feedback d-block" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-12 field-col">
                            <label for="email" class="field-label">Email</label>
                            <input type="email" id="email" name="email" class="w-100 @error('email') is-invalid @enderror" placeholder="Email" value="{{ old('email') }}" required autocomplete="email">
                            @error('email')
                                <span class="invalid-feedback d-block" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-12 field-col">
                            <label for="password" class="field-label">Password</label>
                            <div class="field-pwd d-flex">
                                <input type="password" id="password" name="password" class="w-100 h-auto p-0 bg-transparent border-0 @error('password') is-invalid @enderror" placeholder="Password" required autocomplete="new-password">
                                <button type="button" class="field-pwd-btn body-color icon-16 js-show-password" aria-label="Password hidden"><i class="ri-eye-line d-block lh-1"></i></button>
                            </div>
                            @error('password')
                                <span class="invalid-feedback d-block" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-12 field-col">
                            <label for="password-confirm" class="field-label">Confirm password</label>
                            <div class="field-pwd d-flex">
                                <input type="password" id="password-confirm" name="password_confirmation" class="w-100 h-auto p-0 bg-transparent border-0" placeholder="Confirm password" required autocomplete="new-password">
                                <button type="button" class="field-pwd-btn body-color icon-16 js-show-password" aria-label="Password hidden"><i class="ri-eye-line d-block lh-1"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="customer-account-btn mst-20 mst-sm-30">
                        <div class="row">
                            <div class="col-12 meb-11" data-animate="animate__fadeIn">
                                <label class="cust-checkbox-label checkbox-agree">
                                    <input type="checkbox" class="cust-checkbox checkboxbtn @error('agree_terms') is-invalid @enderror" name="agree_terms" id="agree-terms">
                                    <span class="d-block cust-check"></span>
                                    <span class="login-read">By proceeding, I acknowledge and consent to the stated <a href="{{ route('terms.condition') }}" target="_blank" class="body-secondary-color text-decoration-underline">terms & guidelines</a>.</span>
                                </label>
                                @error('agree_terms')
                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong>Please agree to the terms and guidelines.</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-12" data-animate="animate__fadeIn">
                                <button type="submit" id="register-submit" class="w-100 btn-style secondary-btn disabled opacity-50" style="pointer-events: none;">Create</button>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="mst-12 text-center">
                    <span>Already have an account? <a href="{{ route('login') }}" class="body-secondary-color text-decoration-underline">Log in</a></span>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- register end -->
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

        // Register Page Checkbox Logic
        $('#agree-terms').on('change', function() {
            if ($(this).is(':checked')) {
                $('#register-submit').removeClass('disabled opacity-50').css('pointer-events', 'auto');
            } else {
                $('#register-submit').addClass('disabled opacity-50').css('pointer-events', 'none');
            }
        });
    });
</script>
@endpush
