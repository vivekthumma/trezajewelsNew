@extends('layouts.app')

@section('title', 'Payment Policy')

@section('content')
<!-- breadcrumb-area start -->
<div class="breadcrumb-area ptb-15" data-bgimg="{{ asset('assets/images/index2/home-about-banner.jpg') }}">
    <div class="container">
        <span class="d-block extra-color"><a href="{{ url('/') }}" class="extra-color">Home</a> / Payment policy</span>
    </div>
</div>
<!-- breadcrumb-area end -->

<!-- main start -->
<main id="main">
    <!-- payment-policy start -->
    <section class="payment-policy section-ptb">
        <div class="container">
            <div class="section-capture text-center" data-animate="animate__fadeIn">
                <div class="section-title">
                    <h2 class="section-heading">Payment Policy</h2>
                </div>
            </div>
            <div class="row row-mtm justify-content-center">
                <div class="col-12 col-lg-10">
                    <div class="policy-item pb-4 mb-4 border-bottom" data-animate="animate__fadeIn">
                        <h6 class="font-18 mb-3">What payment methods can i use?</h6>
                        <p class="mst-19 text-muted">We accept a variety of payment methods including major credit and debit cards, digital wallets like paypal and apple pay, and bank transfers. Ensure your selected method is supported to avoid transaction issues. For international payments, check our supported currencies list to make sure your payment method is compatible.</p>
                    </div>

                    <div class="policy-item pb-4 mb-4 border-bottom" data-animate="animate__fadeIn">
                        <h6 class="font-18 mb-3">How are charges applied during checkout?</h6>
                        <p class="mst-19 text-muted">Charges include the total cost of items, applicable taxes based on your location, and any additional fees related to your payment method. All charges will be clearly displayed before you confirm your purchase to ensure transparency and avoid unexpected costs.</p>
                    </div>

                    <div class="policy-item pb-4 mb-4 border-bottom" data-animate="animate__fadeIn">
                        <h6 class="font-18 mb-3">Can i change my payment details after purchase?</h6>
                        <p class="mst-19 text-muted">Once a transaction is processed, payment details cannot be altered. However, if you have a subscription or recurring payment plan, you can update your payment details before the next billing cycle begins to ensure uninterrupted service.</p>
                    </div>

                    <div class="policy-item pb-4 mb-4 border-bottom" data-animate="animate__fadeIn">
                        <h6 class="font-18 mb-3">What should i do if my payment fails?</h6>
                        <p class="mst-19 text-muted">If your payment fails, you’ll receive an error notification with instructions to retry. Common issues include insufficient funds or incorrect payment details. Ensure your payment method has sufficient balance and is entered correctly. If the problem persists, contact our support team for assistance to resolve any issues promptly.</p>
                    </div>

                    <div class="policy-item pb-4 mb-4 border-bottom" data-animate="animate__fadeIn">
                        <h6 class="font-18 mb-3">Are there additional fees for certain payment methods?</h6>
                        <p class="mst-19 text-muted">Some payment methods may incur extra fees, such as transaction fees for international payments or processing fees for specific digital wallets. These fees will be detailed during the checkout process so you can choose the most cost-effective payment option.</p>
                    </div>

                    <div class="policy-item pb-4 mb-4 border-bottom" data-animate="animate__fadeIn">
                        <h6 class="font-18 mb-3">How can i get a refund if needed?</h6>
                        <p class="mst-19 text-muted">To request a refund, please contact our customer support team with your order details. Refunds are processed according to our return policy, which includes time limits and conditions for eligibility. Refunds will be issued to the original payment method used at checkout and may take a few business days to reflect in your account.</p>
                    </div>

                    <div class="policy-item pb-4 mb-4 border-bottom" data-animate="animate__fadeIn">
                        <h6 class="font-18 mb-3">Are my payment details secure?</h6>
                        <p class="mst-19 text-muted">Yes, we use advanced encryption and security protocols to protect your payment information during transactions. Our payment system complies with industry standards to ensure your data is kept safe from unauthorized access. We also regularly update our security measures to safeguard against emerging threats and ensure your financial information remains confidential.</p>
                    </div>

                    <div class="policy-item pb-4 mb-4 border-bottom" data-animate="animate__fadeIn">
                        <h6 class="font-18 mb-3">Can i save my payment details for future purchases?</h6>
                        <p class="mst-19 text-muted">We offer the option to save payment details for convenience on future purchases, but this feature is optional. You can enable or disable it in your account settings. For enhanced security, saved payment methods are stored with encryption and are accessible only through secure login.</p>
                    </div>

                    <div class="policy-item pb-4 mb-4 border-bottom" data-animate="animate__fadeIn">
                        <h6 class="font-18 mb-3">What should i do if i see an unauthorized charge?</h6>
                        <p class="mst-19 text-muted">If you notice an unauthorized charge, contact our customer service immediately to report the issue. We will investigate the charge and assist in resolving any discrepancies. In the meantime, review your payment method statements and consider reaching out to your bank or card issuer to prevent further unauthorized transactions.</p>
                    </div>

                    <div class="policy-item pb-4 mb-4 border-bottom" data-animate="animate__fadeIn">
                        <h6 class="font-18 mb-3">Do you charge any late fees for overdue payments?</h6>
                        <p class="mst-19 text-muted">Late fees may apply if payments are not received by the due date. These fees are outlined in your purchase agreement and will be added to your total outstanding balance. We send reminders before the due date to help you avoid late fees and ensure timely payment processing.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
<!-- main end -->
@endsection
