@extends('layouts.app')

@section('title', 'My Profile - Treza Jewels')

@push('css')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/account.css') }}">
<style>
    .profile-shell {
        max-width: 1320px;
        margin: 0 auto;
    }

    .profile-sidebar-wrap,
    .profile-card {
        background: #fff;
        border: 1px solid rgba(176, 139, 102, 0.14);
        border-radius: 26px;
        box-shadow: 0 24px 60px rgba(143, 111, 76, 0.08);
    }

    .profile-sidebar-wrap {
        padding: 22px;
    }

    .profile-sidebar-wrap .ap-author {
        background: linear-gradient(180deg, #fffdf9 0%, #f7f0e7 100%);
        border: 1px solid #efe4d7;
        border-radius: 22px;
        padding: 32px 20px;
        margin-bottom: 16px;
    }

    .profile-sidebar-wrap .ap-author img {
        width: 86px;
        height: 86px;
        object-fit: cover;
        border: 4px solid #fff;
        box-shadow: 0 16px 30px rgba(176, 139, 102, 0.18);
    }

    .profile-sidebar-wrap .ap-profile {
        display: grid;
        gap: 10px;
    }

    .profile-sidebar-wrap .ap-profile > a,
    .profile-sidebar-wrap .ap-profile > form > button {
        border-radius: 16px;
        border: 1px solid transparent;
        background: #fcfaf7;
        min-height: 56px;
        transition: all .25s ease;
    }

    .profile-sidebar-wrap .ap-profile > a:hover,
    .profile-sidebar-wrap .ap-profile > form > button:hover {
        border-color: #e8d8c6;
        background: #fff;
        transform: translateY(-1px);
    }

    .profile-sidebar-wrap .ap-profile > a.dominant-color {
        background: #f7f0e7;
        border-color: #ead8c3;
        color: #b08b66 !important;
        font-weight: 600;
    }

    .profile-stack {
        display: grid;
        gap: 28px;
    }

    .profile-card {
        padding: 28px;
    }

    .profile-card-head {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 16px;
        padding-bottom: 18px;
        margin-bottom: 24px;
        border-bottom: 1px solid #eee4d8;
    }

    .profile-card-head h6 {
        margin: 0;
        font-size: 28px;
        font-family: "Marcellus", serif;
        color: #2d2a26;
    }

    .profile-card-subtitle {
        color: #8b8073;
        font-size: 14px;
    }

    .profile-input,
    .profile-textarea,
    .profile-password {
        width: 100%;
        border: 1px solid #e7ded2 !important;
        background: #fffdfb !important;
        border-radius: 16px;
        min-height: 58px;
        padding: 14px 16px !important;
        color: #2f2a26;
        transition: border-color .25s ease, box-shadow .25s ease, background-color .25s ease;
    }

    .profile-textarea {
        min-height: 120px;
        resize: vertical;
    }

    .profile-input:focus,
    .profile-textarea:focus,
    .profile-password input:focus {
        border-color: #cda97f !important;
        box-shadow: 0 0 0 4px rgba(205, 169, 127, 0.12);
        background: #fff !important;
        outline: none;
    }

    .profile-password {
        display: flex;
        align-items: center;
        padding-right: 8px !important;
    }

    .profile-password input {
        border: 0 !important;
        background: transparent !important;
        padding: 0 !important;
        min-height: auto !important;
        box-shadow: none !important;
    }

    .profile-password .field-pwd-btn {
        width: 42px;
        height: 42px;
        border-radius: 50%;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        color: #8f6f4c;
    }

    .profile-actions .btn-style {
        min-height: 56px;
        border-radius: 16px;
        font-weight: 700;
        letter-spacing: .02em;
    }

    .profile-section-note {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 8px 14px;
        border-radius: 999px;
        background: #f7f0e7;
        color: #b08b66;
        font-size: 13px;
        font-weight: 600;
    }

    @media (max-width: 991px) {
        .profile-sidebar-wrap {
            margin-bottom: 22px;
        }
    }

    @media (max-width: 767px) {
        .profile-card,
        .profile-sidebar-wrap {
            padding: 18px;
            border-radius: 20px;
        }

        .profile-sidebar-wrap .ap-author {
            padding: 24px 16px;
        }

        .profile-card-head h6 {
            font-size: 24px;
        }
    }
</style>
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
    <div class="container profile-shell">
        <div class="row row-mtm align-items-lg-start">
            <div class="col-12 col-lg-4 col-xl-3 p-lg-sticky top-0">
                <div class="profile-sidebar-wrap">
                    @include('frontend.profile.sidebar')
                </div>
            </div>
            <div class="col-12 col-lg-8 col-xl-9 p-lg-sticky top-0">
                <div class="ap-detail profile-stack">
                    <!-- Personal Info Form -->
                    <form method="post" action="{{ route('profile.update') }}">
                        @csrf
                        <div class="ap-detail-info profile-card">
                            <div class="acc-info">
                                <div class="profile-card-head">
                                    <div>
                                        <h6>Personal information</h6>
                                        <div class="profile-card-subtitle">Keep your contact and delivery details up to date.</div>
                                    </div>
                                    <span class="profile-section-note"><i class="ri-user-smile-line"></i> Account details</span>
                                </div>
                                <div class="acc-detail mst-22">
                                    <div class="acc-detail-form">
                                        <div class="acc-detail-field">
                                            <div class="row field-row">
                                                <div class="col-12 col-md-12 field-col">
                                                    <label for="name" class="field-label">Full Name</label>
                                                    <input type="text" id="name" name="name" class="profile-input @error('name') is-invalid @enderror" value="{{ old('name', $user->name) }}" placeholder="Full name">
                                                    @error('name') <span class="invalid-feedback d-block"><strong>{{ $message }}</strong></span> @enderror
                                                </div>
                                                <div class="col-12 col-md-6 field-col">
                                                    <label for="email_display" class="field-label">Email (Read-only)</label>
                                                    <input type="email" id="email_display" class="profile-input bg-light" value="{{ $user->email }}" disabled>
                                                </div>
                                                <div class="col-12 col-md-6 field-col">
                                                    <label for="phone" class="field-label">Phone number</label>
                                                    <input type="text" id="phone" name="phone" class="profile-input @error('phone') is-invalid @enderror" value="{{ old('phone', $user->phone) }}" placeholder="Phone number">
                                                    @error('phone') <span class="invalid-feedback d-block"><strong>{{ $message }}</strong></span> @enderror
                                                </div>
                                                <div class="col-12 field-col">
                                                    <label for="address" class="field-label">Address</label>
                                                    <textarea id="address" name="address" class="profile-textarea" rows="3" placeholder="Shipping address">{{ old('address', $user->address) }}</textarea>
                                                    @error('address') <span class="invalid-feedback d-block"><strong>{{ $message }}</strong></span> @enderror
                                                </div>
                                                <div class="col-12 col-md-4 field-col">
                                                    <label for="city" class="field-label">City</label>
                                                    <input type="text" id="city" name="city" class="profile-input" value="{{ old('city', $user->city) }}" placeholder="City">
                                                </div>
                                                <div class="col-12 col-md-4 field-col">
                                                    <label for="state" class="field-label">State</label>
                                                    <input type="text" id="state" name="state" class="profile-input" value="{{ old('state', $user->state) }}" placeholder="State">
                                                </div>
                                                <div class="col-12 col-md-4 field-col">
                                                    <label for="pincode" class="field-label">Pincode</label>
                                                    <input type="text" id="pincode" name="pincode" class="profile-input" value="{{ old('pincode', $user->pincode) }}" placeholder="Pincode">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="ap-profile-button mst-20 mst-sm-30 profile-actions">
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

                    <!-- Password Update Form -->
                    <form method="post" action="{{ route('profile.password') }}">
                        @csrf
                        <div class="ap-other-info profile-card">
                            <div class="acc-info">
                                <div class="profile-card-head">
                                    <div>
                                        <h6>Update Password</h6>
                                        <div class="profile-card-subtitle">Use a strong password to keep your account secure.</div>
                                    </div>
                                    <span class="profile-section-note"><i class="ri-shield-keyhole-line"></i> Security</span>
                                </div>
                                <div class="acc-detail mst-22">
                                    <div class="acc-detail-form">
                                        <div class="row field-row">
                                            <div class="col-12 col-md-6 field-col">
                                                <label for="current_password" class="field-label">Current password</label>
                                                <div class="field-pwd profile-password">
                                                    <input type="password" id="current_password" name="current_password" class="w-100 h-auto p-0 bg-transparent border-0 @error('current_password') is-invalid @enderror" placeholder="Current password">
                                                    <button type="button" class="field-pwd-btn body-color icon-16 js-show-password" aria-label="Password hidden"><i class="ri-eye-line d-block lh-1"></i></button>
                                                </div>
                                                @error('current_password') <span class="invalid-feedback d-block"><strong>{{ $message }}</strong></span> @enderror
                                            </div>
                                        </div>
                                        <div class="row field-row">
                                            <div class="col-12 col-md-6 field-col">
                                                <label for="password" class="field-label">New password</label>
                                                <div class="field-pwd profile-password">
                                                    <input type="password" id="password" name="password" class="w-100 h-auto p-0 bg-transparent border-0 @error('password') is-invalid @enderror" placeholder="New password">
                                                    <button type="button" class="field-pwd-btn body-color icon-16 js-show-password" aria-label="Password hidden"><i class="ri-eye-line d-block lh-1"></i></button>
                                                </div>
                                                @error('password') <span class="invalid-feedback d-block"><strong>{{ $message }}</strong></span> @enderror
                                            </div>
                                            <div class="col-12 col-md-6 field-col">
                                                <label for="password_confirmation" class="field-label">Confirm password</label>
                                                <div class="field-pwd profile-password">
                                                    <input type="password" id="password_confirmation" name="password_confirmation" class="w-100 h-auto p-0 bg-transparent border-0" placeholder="Confirm password">
                                                    <button type="button" class="field-pwd-btn body-color icon-16 js-show-password" aria-label="Password hidden"><i class="ri-eye-line d-block lh-1"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="ap-profile-button mst-20 mst-sm-30 profile-actions">
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
