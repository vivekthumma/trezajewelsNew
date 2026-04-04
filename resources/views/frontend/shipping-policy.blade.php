@extends('layouts.app')

@section('title', 'Shipping Policy')

@section('content')
<!-- breadcrumb-area start -->
<div class="breadcrumb-area ptb-15" data-bgimg="{{ asset('assets/images/index2/home-about-banner.jpg') }}">
    <div class="container">
        <span class="d-block extra-color"><a href="{{ url('/') }}" class="extra-color">Home</a> / Shipping policy</span>
    </div>
</div>
<!-- breadcrumb-area end -->

<!-- shipping-policy start -->
<section class="shipping-policy section-ptb">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="shipping-policy-wrap">
                    <div class="policy-item pb-4 mb-4 border-bottom">
                        <h6 class="font-20 dominant-color mb-3">Delivery Regions</h6>
                        <p>Our shipping services extend to various regions, ensuring your luxury jewelry reaches you promptly and securely, regardless of your location. We have partnered with reliable global couriers to deliver orders across domestic and international destinations. Our network is designed to provide timely delivery, professional handling, and full support throughout the transit process.</p>
                        <p>To ensure a seamless experience, we cover both remote and urban areas. Depending on your location, delivery times and costs may differ. We strive to keep you informed at every step, providing regular updates and estimated arrival times for your convenience.</p>
                    </div>

                    <div class="policy-item pb-4 mb-4 border-bottom">
                        <h6 class="font-20 dominant-color mb-3">Standard Shipments</h6>
                        <p>For standard jewelry orders, we provide streamlined shipping solutions to ensure efficient delivery to your doorstep. All orders are processed with extreme care to maintain the high-quality condition of our pieces. We use trusted carriers to ensure these orders are dispatched quickly and reach you safely.</p>
                        <ul class="list-unstyled mst-10 ps-3">
                            <li class="mb-2"><i class="ri-truck-line me-2 text-gold"></i> Domestic Delivery: 3-5 business days.</li>
                            <li class="mb-2"><i class="ri-truck-line me-2 text-gold"></i> International Delivery: 7-14 business days.</li>
                            <li class="mb-2"><i class="ri-truck-line me-2 text-gold"></i> Tracking number provided for all shipments.</li>
                        </ul>
                    </div>

                    <div class="policy-item pb-4 mb-4 border-bottom">
                        <h6 class="font-20 dominant-color mb-3">Luxury & High-Value Shipments</h6>
                        <p>Large or high-value orders are handled with specialized care to ensure maximum security. Depending on the value and weight, your order may be shipped in reinforced packaging. We provide premium tracking for these shipments, allowing you to monitor progress in real-time. Delivery times may vary slightly for high-value items due to additional security verification and insurance processing.</p>
                    </div>

                    <div class="policy-item pb-4 mb-4 border-bottom">
                        <h6 class="font-20 dominant-color mb-3">Monitoring Your Shipment</h6>
                        <p>To track your order, use the tracking number provided in your shipping confirmation email. You can enter this number on our website's <a href="{{ url('track-order') }}" class="text-gold">Track Order</a> page or directly on the carrier's portal for real-time status updates. You can also view the latest progress by logging into your account and visiting your order history.</p>
                    </div>

                    <div class="policy-item pb-4 mb-4 border-bottom">
                        <h6 class="font-20 dominant-color mb-3">Receiving Your Shipment</h6>
                        <p>Upon delivery, please inspect the package carefully before signing. Ensure the tamper-evident seal is intact. If you notice any visible damage or signs of tampering, please document the issue with photographs and contact our customer service team immediately. Proper documentation at the time of receipt is essential for any insurance claims.</p>
                    </div>

                    <div class="policy-item">
                        <h6 class="font-20 dominant-color mb-3">Contact Information</h6>
                        <p>For specialized shipping requests or questions regarding international customs, please contact our logistics team:</p>
                        <p class="mst-10"><strong>Email:</strong> {{ setting('site_email', 'shipping@trezajewels.com') }}</p>
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
<!-- shipping-policy end -->
@endsection
