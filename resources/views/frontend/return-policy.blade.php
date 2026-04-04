@extends('layouts.app')

@section('title', 'Return Policy')

@section('content')
<!-- breadcrumb-area start -->
<div class="breadcrumb-area ptb-15" data-bgimg="{{ asset('assets/images/index2/home-about-banner.jpg') }}">
    <div class="container">
        <span class="d-block extra-color"><a href="{{ url('/') }}" class="extra-color">Home</a> / Return policy</span>
    </div>
</div>
<!-- breadcrumb-area end -->

<!-- return-policy start -->
<section class="return-policy section-ptb">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="return-policy-wrap">
                    <div class="policy-item pb-4 mb-4 border-bottom">
                        <h6 class="font-20 dominant-color mb-3">Satisfied With Your Purchase?</h6>
                        <p>No problem! We believe in excellence and are dedicated to resolving any issues with your order swiftly. If you’re not fully satisfied with your purchase, we’ve got you covered. Our commitment to perfection means we will address any issues promptly and ensure you’re pleased with your order. Don’t worry; we’ll resolve it quickly.</p>
                        <p>We aim to achieve perfect results for every customer, so if you encounter any difficulties with your order, we are dedicated to resolving them as our top priority.</p>
                    </div>

                    <div class="policy-item pb-4 mb-4 border-bottom">
                        <h6 class="font-20 dominant-color mb-3">Steps For Obtaining A Return:</h6>
                        <p>To request a return, follow these simple steps:</p>
                        <ul class="list-unstyled mst-10 ps-3">
                            <li class="mb-3">
                                <div class="d-flex">
                                    <span class="step-num text-white bg-gold rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 25px; height: 25px; min-width: 25px; font-size: 14px;">1</span>
                                    <p class="mb-0"><strong>Contact Support:</strong> Start by contacting our support team through email or phone. Provide your order number, item details, and the reason for the return.</p>
                                </div>
                            </li>
                            <li class="mb-3">
                                <div class="d-flex">
                                    <span class="step-num text-white bg-gold rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 25px; height: 25px; min-width: 25px; font-size: 14px;">2</span>
                                    <p class="mb-0"><strong>Get Authorization:</strong> Our team will review your request and send you a return authorization with detailed instructions on how to proceed.</p>
                                </div>
                            </li>
                            <li class="mb-3">
                                <div class="d-flex">
                                    <span class="step-num text-white bg-gold rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 25px; height: 25px; min-width: 25px; font-size: 14px;">3</span>
                                    <p class="mb-0"><strong>Pack the Item:</strong> Once authorized, carefully pack the item with its original packaging and all accessories included. Ensure the return label is attached.</p>
                                </div>
                            </li>
                            <li class="mb-3">
                                <div class="d-flex">
                                    <span class="step-num text-white bg-gold rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 25px; height: 25px; min-width: 25px; font-size: 14px;">4</span>
                                    <p class="mb-0"><strong>Ship It Back:</strong> Ship the item to the designated address provided. Once inspected, we will process your refund or exchange.</p>
                                </div>
                            </li>
                        </ul>
                    </div>

                    <div class="policy-item pb-4 mb-4 border-bottom">
                        <h6 class="font-20 dominant-color mb-3">Exceptions</h6>
                        <p>Please note that certain items are not eligible for return or exchange due to their nature:</p>
                        <ul class="list-unstyled mst-10 ps-3">
                            <li class="mb-2"><i class="ri-close-circle-fill me-2 text-danger"></i> Personalized or custom-made jewelry pieces.</li>
                            <li class="mb-2"><i class="ri-close-circle-fill me-2 text-danger"></i> Items marked as "Final Sale" or non-returnable in descriptions.</li>
                            <li class="mb-2"><i class="ri-close-circle-fill me-2 text-danger"></i> Products showing signs of use, wear, or damage not caused by shipping.</li>
                            <li class="mb-2"><i class="ri-close-circle-fill me-2 text-danger"></i> Items without their original packaging, certificates (if applicable), and tags.</li>
                        </ul>
                    </div>

                    <div class="policy-item">
                        <h6 class="font-20 dominant-color mb-3">Contact Information</h6>
                        <p>For any inquiries regarding returns, please reach out to our customer care team:</p>
                        <p class="mst-10"><strong>Email:</strong> {{ setting('site_email', 'support@trezajewels.com') }}</p>
                        <p><strong>Phone:</strong> {{ setting('site_phone', '+91 98765-43210') }}</p>
                        <p class="mt-4"><a href="{{ url('terms-condition') }}" class="text-gold border-bottom border-gold">View our Terms & Conditions</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    .bg-gold {
        background-color: #C9A96E;
    }
    .text-gold {
        color: #C9A96E;
    }
    .border-gold {
        border-color: #C9A96E !important;
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
<!-- return-policy end -->
@endsection
