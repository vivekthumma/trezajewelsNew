@extends('layouts.app')

@php
    $site_logo = setting('site_logo');
    $site_name = config('app.name', 'Treza Jewels');
@endphp

@push('css')
<style>
    /* Premium Policy Page Styles */
    .policy-header {
        background: #fdfbf7;
        padding: 80px 0;
        border-bottom: 1px solid rgba(201, 169, 110, 0.1);
        margin-bottom: 60px;
    }
    .policy-title {
        font-family: 'Marcellus', serif;
        color: #1a1a1a;
        font-size: 3.5rem;
        letter-spacing: 2px;
        margin-bottom: 20px;
    }
    .breadcrumb-luxury {
        font-family: 'Outfit', sans-serif;
        text-transform: uppercase;
        letter-spacing: 2px;
        font-size: 0.8rem;
    }
    .breadcrumb-luxury a {
        color: #C9A96E;
        text-decoration: none;
    }
    .breadcrumb-luxury .active {
        color: #888;
    }
    .policy-content-wrapper {
        max-width: 900px;
        margin: 0 auto 100px;
        padding: 0 20px;
    }
    .policy-section {
        margin-bottom: 50px;
    }
    .policy-section h6 {
        font-family: 'Marcellus', serif;
        color: #C9A96E;
        font-size: 1.4rem;
        margin-bottom: 20px;
        border-bottom: 1px solid rgba(201, 169, 110, 0.2);
        padding-bottom: 15px;
    }
    .policy-section p {
        font-family: 'Outfit', sans-serif;
        color: #555;
        line-height: 1.8;
        font-size: 1.05rem;
        margin-bottom: 1.5rem;
    }
    .policy-last-updated {
        font-style: italic;
        color: #999;
        font-size: 0.9rem;
        margin-top: 50px;
        border-top: 1px solid #eee;
        padding-top: 20px;
    }
    @media (max-width: 768px) {
        .policy-title { font-size: 2.5rem; }
    }
</style>
@endpush

@section('content')
<section class="policy-header text-center">
    <div class="container">
        <nav class="breadcrumb-luxury mb-4">
            <a href="{{ url('/') }}">Home</a>
            <span class="mx-3 text-muted">/</span>
            <span class="active">Terms & Conditions</span>
        </nav>
        <h1 class="policy-title">Terms & Conditions</h1>
    </div>
</section>

<section class="policy-body">
    <div class="container">
        <div class="policy-content-wrapper">
            <div class="policy-section">
                <h6>User Guidelines & Policies</h6>
                <p>Welcome to {{ $site_name }}. By accessing our website or making a purchase, you agree to follow our established rules and procedures. These include guidelines on payment, privacy, and acceptable use of our services.</p>
                <p>Any misuse or violation of these policies may result in restricted access or termination of your account. We recommend reviewing these policies regularly, as updates may occur without prior notice.</p>
            </div>

            <div class="policy-section">
                <h6>Service Rules & Agreements</h6>
                <p>Our agreements detail the conditions under which you can use our services and access our content safely. By engaging with our platform, you consent to adhere to the outlined terms. These include guidelines for account creation, content usage, and payment methods.</p>
                <p>Failure to comply may lead to suspension or termination of your access to our services. We reserve the right to update these conditions as needed. Continued use of our services after changes indicates your acceptance of the revised terms.</p>
            </div>

            <div class="policy-section">
                <h6>User Rights & Obligations</h6>
                <p>As a user, you have the right to access our services, provided you comply with our policies. Your obligations include respecting our content, maintaining your account security, and adhering to the terms of use.</p>
                <p>Your rights include the ability to access and use our services as intended, receive customer support, and have your personal information protected under our privacy policy. You are obligated to use our services in a lawful manner, refrain from any unauthorized activities, and report any security breaches.</p>
            </div>

            <div class="policy-section">
                <h6>Usage Terms & Policies</h6>
                <p>Our platform's terms govern how you can interact with our services, ensuring a safe and fair experience for all users. You are required to use our services in accordance with these rules, which include guidelines on account creation, payment methods, content usage, and prohibited activities.</p>
                <p>Any breach of these terms may result in restricted access or termination of your account. We aim to protect your rights while maintaining the integrity of our platform through these established policies.</p>
            </div>

            <div class="policy-section">
                <h6>Legal Policies & Conditions</h6>
                <p>Our rules govern the legal relationship between you and our platform, protecting both parties involved. These conditions outline your obligations, ensuring compliance with laws and our guidelines when using our services.</p>
                <p>By accessing and using our platform, you agree to adhere to our established rules, which include the protection of intellectual property, the appropriate use of content, and the maintenance of confidentiality. Any violation, such as unauthorized use of our materials or failure to comply with payment obligations, may result in legal action.</p>
            </div>

            <div class="policy-last-updated">
                Last updated: {{ date('F d, Y') }}
            </div>
        </div>
    </div>
</section>
@endsection
