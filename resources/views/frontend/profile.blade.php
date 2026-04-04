@extends('layouts.app')

@section('title', 'My Profile - Treza Jewels')

@push('css')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/account.css') }}">
@endpush

@section('content')
<!-- breadcrumb-area start -->
<div class="breadcrumb-area ptb-15" data-bgimg="{{ asset('assets/images/other/breadcrumb-bgimg.jpg') }}">
    <div class="container">
        <span class="d-block extra-color"><a href="{{ url('/') }}" class="extra-color">Home</a> / Profile</span>
    </div>
</div>
<!-- breadcrumb-area end -->

<!-- account-page start -->
<section class="account-page section-ptb">
    <div class="container">
        <div class="row row-mtm align-items-lg-start">
            <div class="col-12 col-lg-4 col-xl-3 p-lg-sticky top-0">
                @include('frontend.profile.sidebar')
            </div>
            <div class="col-12 col-lg-8 col-xl-9 p-lg-sticky top-0">
                <div class="ap-detail">
                    <!-- Personal Info Form -->
                    <form method="post" action="{{ route('profile.update') }}">
                        @csrf
                        <div class="ap-detail-info">
                            <div class="acc-info">
                                <div class="acc-title">
                                    <h6 class="font-18">Personal information</h6>
                                </div>
                                <div class="acc-detail mst-22">
                                    <div class="acc-detail-form">
                                        <div class="acc-detail-field">
                                            <div class="row field-row">
                                                <div class="col-12 col-md-12 field-col">
                                                    <label for="name" class="field-label">Full Name</label>
                                                    <input type="text" id="name" name="name" class="w-100 @error('name') is-invalid @enderror" value="{{ old('name', $user->name) }}" placeholder="Full name">
                                                    @error('name') <span class="invalid-feedback d-block"><strong>{{ $message }}</strong></span> @enderror
                                                </div>
                                                <div class="col-12 col-md-6 field-col">
                                                    <label for="email_display" class="field-label">Email (Read-only)</label>
                                                    <input type="email" id="email_display" class="w-100 bg-light" value="{{ $user->email }}" disabled>
                                                </div>
                                                <div class="col-12 col-md-6 field-col">
                                                    <label for="phone" class="field-label">Phone number</label>
                                                    <input type="text" id="phone" name="phone" class="w-100 @error('phone') is-invalid @enderror" value="{{ old('phone', $user->phone) }}" placeholder="Phone number">
                                                    @error('phone') <span class="invalid-feedback d-block"><strong>{{ $message }}</strong></span> @enderror
                                                </div>
                                                <div class="col-12 field-col">
                                                    <label for="address" class="field-label">Address</label>
                                                    <textarea id="address" name="address" class="w-100 p-2" rows="3" placeholder="Shipping address">{{ old('address', $user->address) }}</textarea>
                                                    @error('address') <span class="invalid-feedback d-block"><strong>{{ $message }}</strong></span> @enderror
                                                </div>
                                                <div class="col-12 col-md-4 field-col">
                                                    <label for="city" class="field-label">City</label>
                                                    <input type="text" id="city" name="city" class="w-100" value="{{ old('city', $user->city) }}" placeholder="City">
                                                </div>
                                                <div class="col-12 col-md-4 field-col">
                                                    <label for="state" class="field-label">State</label>
                                                    <input type="text" id="state" name="state" class="w-100" value="{{ old('state', $user->state) }}" placeholder="State">
                                                </div>
                                                <div class="col-12 col-md-4 field-col">
                                                    <label for="pincode" class="field-label">Pincode</label>
                                                    <input type="text" id="pincode" name="pincode" class="w-100" value="{{ old('pincode', $user->pincode) }}" placeholder="Pincode">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="ap-profile-button mst-20 mst-sm-30">
                                            <div class="row btn-row">
                                                <div class="col-12 col-sm-6 col-xl-3">
                                                    <button type="submit" class="w-100 acc-save btn-style quaternary-btn">Save Changes</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>

                    <hr class="mst-30 pst-30 bst">

                    <!-- Password Update Form -->
                    <form method="post" action="{{ route('profile.password') }}">
                        @csrf
                        <div class="ap-other-info">
                            <div class="acc-info">
                                <div class="acc-title">
                                    <h6 class="font-18">Update Password</h6>
                                </div>
                                <div class="acc-detail mst-22">
                                    <div class="acc-detail-form">
                                        <div class="row field-row">
                                            <div class="col-12 col-md-6 field-col">
                                                <label for="current_password" class="field-label">Current password</label>
                                                <div class="field-pwd d-flex border-bottom">
                                                    <input type="password" id="current_password" name="current_password" class="w-100 h-auto p-0 bg-transparent border-0 @error('current_password') is-invalid @enderror" placeholder="Current password">
                                                    <button type="button" class="field-pwd-btn body-color icon-16 js-show-password" aria-label="Password hidden"><i class="ri-eye-line d-block lh-1"></i></button>
                                                </div>
                                                @error('current_password') <span class="invalid-feedback d-block"><strong>{{ $message }}</strong></span> @enderror
                                            </div>
                                        </div>
                                        <div class="row field-row">
                                            <div class="col-12 col-md-6 field-col">
                                                <label for="password" class="field-label">New password</label>
                                                <div class="field-pwd d-flex border-bottom">
                                                    <input type="password" id="password" name="password" class="w-100 h-auto p-0 bg-transparent border-0 @error('password') is-invalid @enderror" placeholder="New password">
                                                    <button type="button" class="field-pwd-btn body-color icon-16 js-show-password" aria-label="Password hidden"><i class="ri-eye-line d-block lh-1"></i></button>
                                                </div>
                                                @error('password') <span class="invalid-feedback d-block"><strong>{{ $message }}</strong></span> @enderror
                                            </div>
                                            <div class="col-12 col-md-6 field-col">
                                                <label for="password_confirmation" class="field-label">Confirm password</label>
                                                <div class="field-pwd d-flex border-bottom">
                                                    <input type="password" id="password_confirmation" name="password_confirmation" class="w-100 h-auto p-0 bg-transparent border-0" placeholder="Confirm password">
                                                    <button type="button" class="field-pwd-btn body-color icon-16 js-show-password" aria-label="Password hidden"><i class="ri-eye-line d-block lh-1"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="ap-profile-button mst-20 mst-sm-30">
                                            <div class="row btn-row">
                                                <div class="col-12 col-sm-6 col-xl-3">
                                                    <button type="submit" class="w-100 acc-save btn-style quaternary-btn">Update Password</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- account-page end -->
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
