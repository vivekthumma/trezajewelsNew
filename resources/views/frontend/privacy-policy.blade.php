@extends('layouts.app')

@section('title', 'Privacy Policy')

@section('content')
<!-- breadcrumb-area start -->
<div class="breadcrumb-area ptb-15" data-bgimg="{{ asset('assets/images/index2/home-about-banner.jpg') }}">
    <div class="container">
        <span class="d-block extra-color"><a href="{{ url('/') }}" class="extra-color">Home</a> / Privacy policy</span>
    </div>
</div>
<!-- breadcrumb-area end -->

<!-- privacy-policy start -->
<section class="privacy-policy section-ptb">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="privacy-policy-wrap">
                    <div class="policy-item pb-4 mb-4 border-bottom">
                        <h6 class="font-20 dominant-color mb-3">Protecting your data</h6>
                        <p>We prioritize the security and confidentiality of your personal information. Our systems are designed with robust measures to safeguard your data against unauthorized access, loss, or misuse. We regularly update our security protocols and ensure that your information is handled with the utmost care and responsibility.</p>
                    </div>

                    <div class="policy-item pb-4 mb-4 border-bottom">
                        <h6 class="font-20 dominant-color mb-3">Details and data we collect</h6>
                        <p>We collect various types of data to improve the services we offer to users, including:</p>
                        <ul class="list-unstyled mst-10 ps-3">
                            <li class="mb-2"><i class="ri-checkbox-circle-fill me-2 text-gold"></i> Personal information like names and contact details.</li>
                            <li class="mb-2"><i class="ri-checkbox-circle-fill me-2 text-gold"></i> Financial data, including payment information, for transaction processing.</li>
                            <li class="mb-2"><i class="ri-checkbox-circle-fill me-2 text-gold"></i> Browsing activity to help us understand user preferences and enhance experience.</li>
                            <li class="mb-2"><i class="ri-checkbox-circle-fill me-2 text-gold"></i> This information may include address, contact details, purchase history, and usage patterns.</li>
                        </ul>
                    </div>

                    <div class="policy-item pb-4 mb-4 border-bottom">
                        <h6 class="font-20 dominant-color mb-3">Methods for gathering personal and other data</h6>
                        <p>We collect personal information through several channels:</p>
                        <ul class="list-unstyled mst-10 ps-3">
                            <li class="mb-2"><i class="ri-checkbox-circle-fill me-2 text-gold"></i> Personal information through forms you fill out on our website and apps.</li>
                            <li class="mb-2"><i class="ri-checkbox-circle-fill me-2 text-gold"></i> Cookies and similar technologies to track user activity and enhance experiences.</li>
                            <li class="mb-2"><i class="ri-checkbox-circle-fill me-2 text-gold"></i> Data is gathered during interactions, including when you sign up or make a purchase.</li>
                            <li class="mb-2"><i class="ri-checkbox-circle-fill me-2 text-gold"></i> Information helps us provide support, respond to inquiries, and improve overall service.</li>
                        </ul>
                    </div>

                    <div class="policy-item pb-4 mb-4 border-bottom">
                        <h6 class="font-20 dominant-color mb-3">Data collection by our partners</h6>
                        <p>Information gathering by our affiliates includes a range of methods to enhance our services and understand user needs better. This may involve collecting data through forms, surveys, and other digital interactions. We value your privacy and handle all information according to strict data protection standards.</p>
                    </div>

                    <div class="policy-item pb-4 mb-4 border-bottom">
                        <h6 class="font-20 dominant-color mb-3">How we handle your personal data</h6>
                        <p>We use your data to personalize services, improve user experience, and offer relevant updates:</p>
                        <ul class="list-unstyled mst-10 ps-3">
                            <li class="mb-2"><i class="ri-checkbox-circle-fill me-2 text-gold"></i> Ensuring accurate delivery of products and efficient service.</li>
                            <li class="mb-2"><i class="ri-checkbox-circle-fill me-2 text-gold"></i> Managing orders and providing timely, effective support.</li>
                            <li class="mb-2"><i class="ri-checkbox-circle-fill me-2 text-gold"></i> Sending marketing updates and enabling social media sharing features.</li>
                            <li class="mb-2"><i class="ri-checkbox-circle-fill me-2 text-gold"></i> Offering product features and meeting your requests efficiently.</li>
                        </ul>
                    </div>

                    <div class="policy-item pb-4 mb-4 border-bottom">
                        <h6 class="font-20 dominant-color mb-3">How we share personal data</h6>
                        <p>We only share personal data when necessary and with your consent:</p>
                        <ul class="list-unstyled mst-10 ps-3">
                            <li class="mb-2"><i class="ri-checkbox-circle-fill me-2 text-gold"></i> With partners for stated business aims noted in this privacy guide.</li>
                            <li class="mb-2"><i class="ri-checkbox-circle-fill me-2 text-gold"></i> With trusted providers aiding us in tasks outlined within this notice.</li>
                            <li class="mb-2"><i class="ri-checkbox-circle-fill me-2 text-gold"></i> Through our tools where you can choose to share your info as detailed in this policy.</li>
                        </ul>
                    </div>

                    <div class="policy-item pb-4 mb-4 border-bottom">
                        <h6 class="font-20 dominant-color mb-3">Duration for retaining personal data</h6>
                        <p>We retain your personal information only for as long as necessary to fulfill the purposes for which it was collected, such as processing transactions, complying with legal obligations, or providing customer support. Once the data is no longer needed, it is securely deleted or anonymized.</p>
                    </div>

                    <div class="policy-item pb-4 mb-4 border-bottom">
                        <h6 class="font-20 dominant-color mb-3">Security practices we implement</h6>
                        <p>We employ a variety of security measures to protect your personal data:</p>
                        <ul class="list-unstyled mst-10 ps-3">
                            <li class="mb-2"><i class="ri-checkbox-circle-fill me-2 text-gold"></i> Systems use encryption to safeguard your data during transmission and storage.</li>
                            <li class="mb-2"><i class="ri-checkbox-circle-fill me-2 text-gold"></i> Regular security assessments and audits to identify potential vulnerabilities.</li>
                            <li class="mb-2"><i class="ri-checkbox-circle-fill me-2 text-gold"></i> Access restricted to authorized personnel trained in data protection.</li>
                            <li class="mb-2"><i class="ri-checkbox-circle-fill me-2 text-gold"></i> Usage of firewalls and intrusion detection systems to protect against attacks.</li>
                        </ul>
                    </div>

                    <div class="policy-item pb-4 mb-4 border-bottom">
                        <h6 class="font-20 dominant-color mb-3">Available options for you</h6>
                        <p>You have several options regarding your privacy preferences. You can update your communication settings, request access to your personal data, and opt out of certain collections. Additionally, you may choose to disable cookies or other tracking technologies through your browser settings.</p>
                    </div>

                    <div class="policy-item">
                        <h6 class="font-20 dominant-color mb-3">How to reach us</h6>
                        <p>For any questions, visit our support portal or use the live chat on our website for immediate help. You can also reach us via:</p>
                        <p class="mst-10"><strong>Email:</strong> {{ setting('site_email', 'contact@trezajewels.com') }}</p>
                        <p><strong>Phone:</strong> {{ setting('site_phone', '+91 98765-43210') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    .text-gold {
        color: #C9A96E;
    }
    .policy-item p {
        color: #777;
        line-height: 1.8;
    }
    .policy-item h6 {
        letter-spacing: 1px;
    }
    .section-ptb {
        padding-top: 80px;
        padding-bottom: 80px;
    }
</style>
<!-- privacy-policy end -->
@endsection
